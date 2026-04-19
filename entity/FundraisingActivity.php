<?php

require_once __DIR__ . '/../config/DBConnection.php';

class FundraisingActivity
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function createFRA(
    string $campaignTitle,
    string $category,
    string $description,
    string $endDate,
    string $goalAmount,
    string $doneeName,
    string $phone
): bool
{
    $sql = "INSERT INTO fundraising_activity
            (campaign_title, category, description, end_date, goal_amount, donee_name, phone)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssssdss",
        $campaignTitle,
        $category,
        $description,
        $endDate,
        $goalAmount,
        $doneeName,
        $phone
    );

    return $stmt->execute();
}

    public function getAllFRA(): array
{
    $sql = "SELECT id, campaign_title, category, goal_amount, end_date, description, donee_name, phone
            FROM fundraising_activity
            ORDER BY id DESC";

    $result = $this->db->query($sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}

public function deleteFRA(int $id): bool
{
    $sql = "DELETE FROM fundraising_activity WHERE id = ?";
    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
}