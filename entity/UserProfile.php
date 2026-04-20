<?php
require_once __DIR__ . '/../config/DBConnection.php';

class UserProfile {
    private mysqli $db;

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

    public function getAllProfiles(): array {
        $sql = "SELECT p.profile_id, p.profile_name, p.description,
                       COUNT(u.id) AS user_count
                FROM user_profiles p
                LEFT JOIN users u ON u.profile = p.profile_name
                GROUP BY p.profile_id, p.profile_name, p.description
                ORDER BY p.profile_name";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
