<?php

require_once __DIR__ . '/../config/DBConnection.php';

class dashboardDNEntity
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getDonationStats(string $username): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) AS total_donations,
                COALESCE(SUM(amount), 0) AS total_donated
            FROM donation
            WHERE donee_name = ?
        ");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function getSavedCount(string $username): int
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS saved_count
            FROM favourite_fundraising_activity
            WHERE username = ?
        ");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $row = $stmt->get_result()->fetch_assoc();

        return $row['saved_count'] ?? 0;
    }

    public function getRecentDonations(string $username): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                fa.campaign_title,
                d.amount,
                d.donation_date
            FROM donation d

            JOIN fundraising_activity fa
                ON d.fra_id = fa.id

            WHERE d.donee_name = ?

            ORDER BY d.donation_date DESC

            LIMIT 5
        ");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getSavedCampaigns(string $username): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                fa.campaign_title,
                fa.category,
                fa.goal_amount

            FROM favourite_fundraising_activity fav

            JOIN fundraising_activity fa
                ON fav.activity_id = fa.id

            WHERE fav.username = ?

            ORDER BY fav.created_at DESC

            LIMIT 5
        ");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTrendingCampaigns(): array
{
    $stmt = $this->db->prepare("
        SELECT 
            fa.campaign_title,
            fa.category,
            fa.goal_amount,

            COALESCE(SUM(d.amount), 0) AS total_raised

        FROM fundraising_activity fa

        LEFT JOIN donation d
            ON fa.id = d.fra_id

        GROUP BY 
            fa.id,
            fa.campaign_title,
            fa.category,
            fa.goal_amount

        ORDER BY total_raised DESC

        LIMIT 5
    ");

    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
}