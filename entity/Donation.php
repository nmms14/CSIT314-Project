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
		$totalDonation = $this->getTotalDonation($fraId);
		
		// Retrieve goal amount
		$sqlGoal = "SELECT goal_amount, end_date
					FROM fundraising_activity
					WHERE id = ?";

		$stmtGoal =
			$this->db->prepare($sqlGoal);

		if (!$stmtGoal) {
			return false;
		}

		$stmtGoal->bind_param(
			"i",
			$fraId
		);

		$stmtGoal->execute();

		$resultGoal = $stmtGoal->get_result();

		$rowGoal = $resultGoal->fetch_assoc();

		$goalAmount = (float)$rowGoal['goal_amount'];
		
		$endDate = strtotime($rowGoal['end_date']);
		
		// Validation, if donate amount > goal amount, return false
		if (
			$totalDonation >= $goalAmount

			||

			($totalDonation + $amount)
			> $goalAmount

			||

			time() > $endDate
		) {
			return false;
		}

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

		$success = $stmt->execute();

		if ($success) {
			$newTotal = $totalDonation + $amount;

			if ($newTotal >= $goalAmount) {

				$sqlCompleted = "INSERT IGNORE INTO completed_fra
								 (fra_id)
								 VALUES (?)";

				$stmtCompleted = $this->db->prepare($sqlCompleted);

				if ($stmtCompleted) {
					$stmtCompleted->bind_param(
						"i",
						$fraId
					);
					$stmtCompleted->execute();
				}
			}
		}

		return $success;
	}
	
	public function getAllDonationHistory(string $username): array
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
		WHERE d.donee_name = ?";

		$stmt = $this->db->prepare($sql);
		
		if (!$stmt) {
			return [];
		}

		$stmt->bind_param(
			"s",
			$username
		);

		$stmt->execute();

		$result = $stmt->get_result();

		return $result->fetch_all(MYSQLI_ASSOC);
	}
	
	public function searchDonationHistory(string $username, string $keyword): array
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
			WHERE d.donee_name = ?
			ORDER BY d.donation_date DESC";

		$stmt = $this->db->prepare($sql);

		if (!$stmt) {
			return [];
		}
		
		$stmt->bind_param(
			"s",
			$username
		);

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
	
	public function getTotalDonation(int $fraId): float
	{
		$sql = "SELECT SUM(amount) AS total
				FROM donation
				WHERE fra_id = ?";

		$stmt = $this->db->prepare($sql);

		if (!$stmt) {
			return 0;
		}

		$stmt->bind_param("i", $fraId);

		$stmt->execute();

		$result = $stmt->get_result();

		$row = $result->fetch_assoc();

		return (float) ($row['total'] ?? 0);
	}
	
	public function getUserDonationAmount(int $fraId, string $doneeName): float
	{
		$sql = "SELECT SUM(amount) AS total
				FROM donation
				WHERE fra_id = ?
				AND donee_name = ?";

		$stmt = $this->db->prepare($sql);

		if (!$stmt) {
			return 0;
		}

		$stmt->bind_param(
			"is",
			$fraId,
			$doneeName
		);

		$stmt->execute();

		$result = $stmt->get_result();

		$row = $result->fetch_assoc();

		return (float) ($row['total'] ?? 0);
	}
	
	public function viewDonatedFRA(string $username): array
	{
		$sql = "SELECT
					fa.id,
					fa.campaign_title,
					fa.category,
					fa.goal_amount,
					fa.end_date,

					SUM(d.amount)
					AS total_raised,

					(
						SELECT SUM(d2.amount)
						FROM donation d2
						WHERE d2.fra_id = fa.id
						AND d2.donee_name = ?
					) AS my_donation

				FROM donation d

				JOIN fundraising_activity fa
				ON d.fra_id = fa.id

				GROUP BY fa.id

				ORDER BY fa.end_date ASC";

		$stmt = $this->db->prepare($sql);

		if (!$stmt) {
			return [];
		}

		$stmt->bind_param(
			"s",
			$username
		);

		$stmt->execute();

		$result = $stmt->get_result();

		return $result->fetch_all(MYSQLI_ASSOC);
	}
}