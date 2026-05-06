<?php
require_once __DIR__ . '/../config/DBConnection.php';

class FavouriteFundraisingActivity {

    private mysqli $db;

    public function __construct() {
        $this->db = DBConnection::getInstance();
    }
	
    public function viewFavouriteFRA(string $username): array {
        $stmt = $this->db->prepare(
            "SELECT fa.*
             FROM fundraising_activity fa
             JOIN favourite_fundraising_activity f
             ON fa.id = f.activity_id
             WHERE f.username = ?"
        );
		
		if (!$stmt) return [];

        $stmt->bind_param("s", $username);
        $stmt->execute();
		
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function saveFavouriteFRA(string $username, int $fraId): bool
{
    $sql = "
        INSERT INTO favourite_fundraising_activity (username, activity_id)
        VALUES (?, ?)
    ";

    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("si", $username, $fraId);

    try {
    return $stmt->execute();
} catch (mysqli_sql_exception $e) {
    return false;
}
}

public function getShortlistedFRA(): array
{
    $sql = "
        SELECT
            fa.id,
            fa.campaign_title,
            fa.category,
            fa.goal_amount,
            fa.end_date,
            COUNT(ffa.id) AS shortlist_count

        FROM fundraising_activity fa

        LEFT JOIN favourite_fundraising_activity ffa
            ON fa.id = ffa.activity_id

        GROUP BY
            fa.id,
            fa.campaign_title,
            fa.category,
            fa.goal_amount,
            fa.end_date

        ORDER BY shortlist_count DESC
    ";

    $result = $this->db->query($sql);

    if (!$result) {
        return [];
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}
}