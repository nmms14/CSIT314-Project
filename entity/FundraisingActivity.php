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
    string $phone,
    string $fundraiserName
): bool
{
    $sql = "INSERT INTO fundraising_activity
            (campaign_title, category, description, end_date, goal_amount, donee_name, phone, fundraiser_name)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssssdsss",
        $campaignTitle,
        $category,
        $description,
        $endDate,
        $goalAmount,
        $doneeName,
        $phone,
        $fundraiserName
    );

    return $stmt->execute();
}

    public function getAllFRA(): array
{
    $sql = "SELECT id, campaign_title, category, goal_amount, end_date, description, donee_name, phone, fundraiser_name
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

public function getFRAById(int $id): ?array
{
$sql = "SELECT id, campaign_title, category, description, end_date, goal_amount, donee_name, phone, fundraiser_name
        FROM fundraising_activity
        WHERE id = ?";

    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row ?: null;
}

public function updateFRA(
    int $id,
    string $campaignTitle,
    string $category,
    string $goalAmount,
    string $endDate,
    string $description,
    string $doneeName,
    string $phone
): bool
{
    $sql = "UPDATE fundraising_activity
            SET campaign_title = ?,
                category = ?,
                goal_amount = ?,
                end_date = ?,
                description = ?,
                donee_name = ?,
                phone = ?
            WHERE id = ?";

    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "sssssssi",
        $campaignTitle,
        $category,
        $goalAmount,
        $endDate,
        $description,
        $doneeName,
        $phone,
        $id
    );

    return $stmt->execute();
}

public function getMatchingFRA(string $keyword): array
{
    $sql = "SELECT id, campaign_title, category, goal_amount, end_date, description, donee_name, phone, fundraiser_name
        FROM fundraising_activity
        WHERE campaign_title LIKE ?
           OR category LIKE ?
           OR description LIKE ?
           OR donee_name LIKE ?
           OR phone LIKE ?
           OR fundraiser_name LIKE ?
        ORDER BY id DESC";

    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        return [];
    }

    $searchTerm = '%' . $keyword . '%';

    $stmt->bind_param(
        "ssssss",
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm
    );

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}
}