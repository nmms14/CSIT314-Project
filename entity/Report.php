<?php

require_once __DIR__ . '/../config/DBConnection.php';

class Report
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function generateMonthlyReport(string $monthString): array
    {
        $monthStartString = $monthString . '-01';
        $monthEndString = date('Y-m-t', strtotime($monthStartString));

        $kpis = [
            'new_users' => 0,
            'new_fra' => 0,
            'new_favourites' => 0,
            'total_users' => 0,
            'total_fra' => 0,
            'total_favourites' => 0,
        ];

        $countInRangeSql = "SELECT COUNT(*) AS c FROM %s WHERE DATE(created_at) BETWEEN ? AND ?";

        foreach ([
            'new_users' => 'user_accounts',
            'new_fra' => 'fundraising_activity',
            'new_favourites' => 'favourite_fundraising_activity',
        ] as $key => $table) {
            $stmt = $this->db->prepare(sprintf($countInRangeSql, $table));
            if ($stmt) {
                $stmt->bind_param("ss", $monthStartString, $monthEndString);
                $stmt->execute();
                $row = $stmt->get_result()->fetch_assoc();
                $kpis[$key] = (int) ($row['c'] ?? 0);
            }
        }

        foreach ([
            'total_users' => 'user_accounts',
            'total_fra' => 'fundraising_activity',
            'total_favourites' => 'favourite_fundraising_activity',
        ] as $key => $table) {
            $result = $this->db->query("SELECT COUNT(*) AS c FROM {$table}");
            if ($result) {
                $row = $result->fetch_assoc();
                $kpis[$key] = (int) ($row['c'] ?? 0);
            }
        }

        $categoryBreakdown = [];
        $result = $this->db->query(
            "SELECT category, COUNT(*) AS total
             FROM fundraising_activity
             GROUP BY category
             ORDER BY total DESC"
        );
        if ($result) {
            $categoryBreakdown = $result->fetch_all(MYSQLI_ASSOC);
        }

        $recentActivities = [];
        $stmt = $this->db->prepare(
            "SELECT campaign_title, category, created_at
             FROM fundraising_activity
             WHERE DATE(created_at) BETWEEN ? AND ?
             ORDER BY created_at DESC"
        );
        if ($stmt) {
            $stmt->bind_param("ss", $monthStartString, $monthEndString);
            $stmt->execute();
            $recentActivities = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        $recentFavourites = [];
        $stmt = $this->db->prepare(
            "SELECT f.username, fa.campaign_title, fa.category, f.created_at
             FROM favourite_fundraising_activity f
             JOIN fundraising_activity fa ON fa.id = f.activity_id
             WHERE DATE(f.created_at) BETWEEN ? AND ?
             ORDER BY f.created_at DESC"
        );
        if ($stmt) {
            $stmt->bind_param("ss", $monthStartString, $monthEndString);
            $stmt->execute();
            $recentFavourites = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        return [
            'meta' => [
                'report_id' => 'MR-' . str_replace('-', '', $monthString) . '-' . substr(md5($monthString . microtime()), 0, 6),
                'month' => $monthString,
                'month_start' => $monthStartString,
                'month_end' => $monthEndString,
                'generated_at' => date('d M Y, g:ia'),
            ],
            'kpis' => $kpis,
            'category_breakdown' => $categoryBreakdown,
            'recent_activities' => $recentActivities,
            'recent_favourites' => $recentFavourites,
        ];
    }

    public function generateWeeklyReport(string $weekStartString): array
    {
        $weekEndString = date('Y-m-d', strtotime($weekStartString . ' +6 days'));

        $kpis = [
            'new_users' => 0,
            'new_fra' => 0,
            'new_favourites' => 0,
            'total_users' => 0,
            'total_fra' => 0,
            'total_favourites' => 0,
        ];

        $countInRangeSql = "SELECT COUNT(*) AS c FROM %s WHERE DATE(created_at) BETWEEN ? AND ?";

        foreach ([
            'new_users' => 'user_accounts',
            'new_fra' => 'fundraising_activity',
            'new_favourites' => 'favourite_fundraising_activity',
        ] as $key => $table) {
            $stmt = $this->db->prepare(sprintf($countInRangeSql, $table));
            if ($stmt) {
                $stmt->bind_param("ss", $weekStartString, $weekEndString);
                $stmt->execute();
                $row = $stmt->get_result()->fetch_assoc();
                $kpis[$key] = (int) ($row['c'] ?? 0);
            }
        }

        foreach ([
            'total_users' => 'user_accounts',
            'total_fra' => 'fundraising_activity',
            'total_favourites' => 'favourite_fundraising_activity',
        ] as $key => $table) {
            $result = $this->db->query("SELECT COUNT(*) AS c FROM {$table}");
            if ($result) {
                $row = $result->fetch_assoc();
                $kpis[$key] = (int) ($row['c'] ?? 0);
            }
        }

        $categoryBreakdown = [];
        $result = $this->db->query(
            "SELECT category, COUNT(*) AS total
             FROM fundraising_activity
             GROUP BY category
             ORDER BY total DESC"
        );
        if ($result) {
            $categoryBreakdown = $result->fetch_all(MYSQLI_ASSOC);
        }

        $recentActivities = [];
        $stmt = $this->db->prepare(
            "SELECT campaign_title, category, created_at
             FROM fundraising_activity
             WHERE DATE(created_at) BETWEEN ? AND ?
             ORDER BY created_at DESC"
        );
        if ($stmt) {
            $stmt->bind_param("ss", $weekStartString, $weekEndString);
            $stmt->execute();
            $recentActivities = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        $recentFavourites = [];
        $stmt = $this->db->prepare(
            "SELECT f.username, fa.campaign_title, fa.category, f.created_at
             FROM favourite_fundraising_activity f
             JOIN fundraising_activity fa ON fa.id = f.activity_id
             WHERE DATE(f.created_at) BETWEEN ? AND ?
             ORDER BY f.created_at DESC"
        );
        if ($stmt) {
            $stmt->bind_param("ss", $weekStartString, $weekEndString);
            $stmt->execute();
            $recentFavourites = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        return [
            'meta' => [
                'report_id' => 'WR-' . date('Ymd', strtotime($weekStartString)) . '-' . substr(md5($weekStartString . microtime()), 0, 6),
                'week_start' => $weekStartString,
                'week_end' => $weekEndString,
                'generated_at' => date('d M Y, g:ia'),
            ],
            'kpis' => $kpis,
            'category_breakdown' => $categoryBreakdown,
            'recent_activities' => $recentActivities,
            'recent_favourites' => $recentFavourites,
        ];
    }

    public function generateDailyReport(string $dayString): array
    {
        $kpis = [
            'new_users' => 0,
            'new_fra' => 0,
            'new_favourites' => 0,
            'total_users' => 0,
            'total_fra' => 0,
            'total_favourites' => 0,
        ];

        $countOnDateSql = "SELECT COUNT(*) AS c FROM %s WHERE DATE(created_at) = ?";

        foreach ([
            'new_users' => 'user_accounts',
            'new_fra' => 'fundraising_activity',
            'new_favourites' => 'favourite_fundraising_activity',
        ] as $key => $table) {
            $stmt = $this->db->prepare(sprintf($countOnDateSql, $table));
            if ($stmt) {
                $stmt->bind_param("s", $dayString);
                $stmt->execute();
                $row = $stmt->get_result()->fetch_assoc();
                $kpis[$key] = (int) ($row['c'] ?? 0);
            }
        }

        foreach ([
            'total_users' => 'user_accounts',
            'total_fra' => 'fundraising_activity',
            'total_favourites' => 'favourite_fundraising_activity',
        ] as $key => $table) {
            $result = $this->db->query("SELECT COUNT(*) AS c FROM {$table}");
            if ($result) {
                $row = $result->fetch_assoc();
                $kpis[$key] = (int) ($row['c'] ?? 0);
            }
        }

        $categoryBreakdown = [];
        $result = $this->db->query(
            "SELECT category, COUNT(*) AS total
             FROM fundraising_activity
             GROUP BY category
             ORDER BY total DESC"
        );
        if ($result) {
            $categoryBreakdown = $result->fetch_all(MYSQLI_ASSOC);
        }

        $recentActivities = [];
        $stmt = $this->db->prepare(
            "SELECT campaign_title, category, created_at
             FROM fundraising_activity
             WHERE DATE(created_at) = ?
             ORDER BY created_at DESC"
        );
        if ($stmt) {
            $stmt->bind_param("s", $dayString);
            $stmt->execute();
            $recentActivities = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        $recentFavourites = [];
        $stmt = $this->db->prepare(
            "SELECT f.username, fa.campaign_title, fa.category, f.created_at
             FROM favourite_fundraising_activity f
             JOIN fundraising_activity fa ON fa.id = f.activity_id
             WHERE DATE(f.created_at) = ?
             ORDER BY f.created_at DESC"
        );
        if ($stmt) {
            $stmt->bind_param("s", $dayString);
            $stmt->execute();
            $recentFavourites = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        return [
            'meta' => [
                'report_id' => 'DR-' . date('Ymd', strtotime($dayString)) . '-' . substr(md5($dayString . microtime()), 0, 6),
                'day' => $dayString,
                'generated_at' => date('d M Y, g:ia'),
            ],
            'kpis' => $kpis,
            'category_breakdown' => $categoryBreakdown,
            'recent_activities' => $recentActivities,
            'recent_favourites' => $recentFavourites,
        ];
    }
}
