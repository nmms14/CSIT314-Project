<?php
require_once __DIR__ . '/../config/DBConnection.php';

class UserProfile {
    private mysqli $db;

    public int $profileID;
    public string $profileName;
    public string $description;
    public int $userCount = 0;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function createUserProfile(string $profileName, string $description): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO user_profiles (profile_name, description) VALUES (?, ?)"
        );

        if (!$stmt) return false;

        $stmt->bind_param('ss', $profileName, $description);

        try {
            $success = $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }

        $stmt->close();
        return $success;
    }

    // Convert a DB row to a UserProfile object
    private function dbRowToProfile(array $row): UserProfile {
        $p = new UserProfile($this->db);
        $p->profileID   = (int)$row['profile_id'];
        $p->profileName = $row['profile_name'];
        $p->description = $row['description'];
        $p->userCount   = (int)($row['user_count'] ?? 0);
        return $p;
    }

    public function getAllProfiles(): array {
        $sql = "SELECT  u.profile                   AS profile_name,
                        COALESCE(p.profile_id, 0)   AS profile_id,
                        COALESCE(p.description, '') AS description,
                        COUNT(u.id)                 AS user_count
                FROM    users u
                LEFT JOIN user_profiles p ON p.profile_name = u.profile
                GROUP BY u.profile, p.profile_id, p.description
                ORDER BY u.profile";
        $result = $this->db->query($sql);

        $profiles = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profiles[] = $this->dbRowToProfile($row);
            }
        }
        return $profiles;
    }

    public function viewUserProfile(int $profileID): ?UserProfile {
        $stmt = $this->db->prepare(
            "SELECT p.profile_id, p.profile_name, p.description,
                    (SELECT COUNT(*) FROM users u WHERE u.profile = p.profile_name) AS user_count
             FROM user_profiles p
             WHERE p.profile_id = ?
             LIMIT 1"
        );

        if (!$stmt) return null;

        $stmt->bind_param('i', $profileID);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        if (!$row) return null;

        return $this->dbRowToProfile($row);
    }
}
?>
