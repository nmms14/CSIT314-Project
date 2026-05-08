<?php

require_once __DIR__ . '/../config/DBConnection.php';

class Donation
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

	public function donateToFRA(int $fraId, string $doneeName, float $amount): bool
	{
		$sql = "INSERT INTO donation
				(fra_id, donee_name, amount)
				VALUES (?, ?, ?)";

		$stmt = $this->db->prepare($sql);

		if (!$stmt) {
			return false;
		}

		$stmt->bind_param(
			"isd",
			$fraId,
			$doneeName,
			$amount
		);

		return $stmt->execute();
	}
	
	public function getAllDonationHistory(): array
	{
		$sql = "SELECT d.*,
               fa.campaign_title,
               fa.category,
               fa.goal_amount,
               fa.end_date,
               (
                   SELECT SUM(d2.amount)
                   FROM donation d2
                   WHERE d2.fra_id = d.fra_id
               ) AS total_donation
        FROM donation d
        JOIN fundraising_activity fa
        ON d.fra_id = fa.id";

		$result = $this->db->query($sql);

		if (!$result) {
			return [];
		}

		return $result->fetch_all(MYSQLI_ASSOC);
	}
	
	public function searchDonationHistory(string $keyword): array
	{
		$sql = "SELECT d.*,
				   fa.campaign_title,
				   fa.category,
				   fa.goal_amount,
				   fa.end_date,
				   (
					   SELECT SUM(d2.amount)
					   FROM donation d2
					   WHERE d2.fra_id = d.fra_id
				   ) AS total_donation
			FROM donation d
			JOIN fundraising_activity fa
			ON d.fra_id = fa.id
			ORDER BY d.donation_date DESC";

		$stmt = $this->db->prepare($sql);

		if (!$stmt) {
			return [];
		}

		$stmt->execute();

		$result = $stmt->get_result();

		$rows = $result->fetch_all(MYSQLI_ASSOC);

		$filtered = [];

		foreach ($rows as $row) {

			$status = 'Ongoing';

			if (
				$row['total_donation'] >= $row['goal_amount'] ||
				time() > strtotime($row['end_date'])
			) {
				$status = 'Completed';
			}

			if (
				strtolower($keyword) === strtolower($status)
				||

				stripos(
					$row['campaign_title'],
					$keyword
				) !== false

				||

				stripos(
					$row['category'],
					$keyword
				) !== false

				||
				(
					is_numeric(
						str_replace('$', '', $keyword)
					)

					&&

					(float)$row['amount'] ==
					(float) str_replace('$', '', $keyword)
				)

				||

				ltrim(
					strtolower(
						date(
							'd M Y',
							strtotime($row['donation_date'])
						)
					),
					'0'
				)

				===

				ltrim(
					strtolower(trim($keyword)),
					'0'
				)
			) {
				$filtered[] = $row;
			}
		}

		return $filtered;
	}
	
}