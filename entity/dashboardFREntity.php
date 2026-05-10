<?php

require_once __DIR__ . '/../config/DBConnection.php';

class dashboardFREntity
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }


    /* =========================
       DASHBOARD STATISTICS
    ========================= */

    public function getDashboardStats(string $username): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(fa.id) AS total_active_fra,

                COALESCE(SUM(fa.goal_amount), 0) AS total_goal,

                COALESCE(SUM(d.total_raised), 0) AS total_raised

            FROM fundraising_activity fa

            LEFT JOIN (
                SELECT 
                    fra_id,
                    SUM(amount) AS total_raised
                FROM donation
                GROUP BY fra_id
            ) d ON fa.id = d.fra_id

            WHERE fa.fundraiser_name = ?

            AND fa.id NOT IN (
                SELECT fra_id FROM completed_fra
            )
        ");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }



    /* =========================
       ACTIVE FRA PROGRESS
    ========================= */

    public function getActiveFRAProgress(string $username): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                fa.id,
                fa.campaign_title,
                fa.goal_amount,

                COALESCE(SUM(d.amount), 0) AS raised_amount

            FROM fundraising_activity fa

            LEFT JOIN donation d
                ON fa.id = d.fra_id

            WHERE fa.fundraiser_name = ?

            AND fa.id NOT IN (
                SELECT fra_id FROM completed_fra
            )

            GROUP BY 
                fa.id,
                fa.campaign_title,
                fa.goal_amount

            ORDER BY fa.created_at DESC
        ");

        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }



    /* =========================
       RECENT ACTIVITIES
    ========================= */

    public function getRecentActivities(string $username): array
    {
        $stmt = $this->db->prepare("
            SELECT 
                'Donation received' AS title,

                CONCAT(
                    '$',
                    FORMAT(d.amount, 0),
                    ' donated to ',
                    fa.campaign_title
                ) AS description,

                d.donation_date AS activity_date

            FROM donation d

            JOIN fundraising_activity fa
                ON d.fra_id = fa.id

            WHERE fa.fundraiser_name = ?


            UNION ALL


            SELECT
                'New FRA created' AS title,

                CONCAT(
                    fa.campaign_title,
                    ' was created'
                ) AS description,

                fa.created_at AS activity_date

            FROM fundraising_activity fa

            WHERE fa.fundraiser_name = ?


            ORDER BY activity_date DESC

            LIMIT 5
        ");

        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}