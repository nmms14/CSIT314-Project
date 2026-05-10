<?php

require_once __DIR__ . '/../config/DBConnection.php';

class dashboardUAEntity
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }
	
	public function getTotalUsers(): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM user_accounts";

        $result = $this->db->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch_assoc();

        return (int)$row['total'];
    }

    public function getSuspendedAccounts(): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM user_accounts
                WHERE status = 'Suspended'";

        $result = $this->db->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch_assoc();
		
        return (int)$row['total'];
    }

    public function getActiveAccounts(): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM user_accounts
                WHERE status = 'Active'";

        $result = $this->db->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch_assoc();

        return (int)$row['total'];
    }

    public function getTotalProfiles(): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM user_profiles";

        $result = $this->db->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch_assoc();

        return (int)$row['total'];
    }

    public function getNewUsers(): int
    {
        $sql = "SELECT COUNT(*) AS total
                FROM user_accounts
                WHERE created_at >=
                DATE_SUB(NOW(), INTERVAL 7 DAY)";

        $result = $this->db->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch_assoc();

        return (int)$row['total'];
    }

    public function getRecentAccounts(): array
    {
        $sql = "SELECT name,
					   username,
					   profile,
					   status,
					   created_at

                FROM user_accounts

                ORDER BY created_at DESC

                LIMIT 5";

        $result = $this->db->query($sql);

        if (!$result) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}