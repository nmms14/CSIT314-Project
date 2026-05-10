<?php
require_once __DIR__ . '/../config/DBConnection.php';

class UserProfile {
    private mysqli $db;

    public function __construct() {
        $this->db = DBConnection::getInstance();
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

    public function updateProf(int $profile_id, string $profile_name, string $description): array {
        $stmt = $this->db->prepare(
            "UPDATE user_profiles SET profile_name = ?, description = ? WHERE profile_id = ?"
        );
        $stmt->bind_param('ssi', $profile_name, $description, $profile_id);

        try {
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return [];
        }

        $sel = $this->db->prepare(
            "SELECT profile_id, profile_name, description, status FROM user_profiles WHERE profile_id = ?"
        );
        $sel->bind_param('i', $profile_id);
        $sel->execute();
        $row = $sel->get_result()->fetch_assoc();

        return $row ?: [];
    }

    public function getAllProfiles(): array {
        $sql = "SELECT p.profile_id, p.profile_name, p.description, p.status,
                       COUNT(u.id) AS user_count
                FROM user_profiles p
                LEFT JOIN user_accounts u ON u.profile = p.profile_name
                GROUP BY p.profile_id, p.profile_name, p.description, p.status
                ORDER BY p.profile_name";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function suspendUserProfile(int $profileID): bool {
        $stmt = $this->db->prepare(
            "UPDATE user_profiles SET status = 'Suspended' WHERE profile_id = ?"
        );

        if (!$stmt) return false;

        $stmt->bind_param('i', $profileID);

        try {
            $success = $stmt->execute() && $stmt->affected_rows > 0;
        } catch (mysqli_sql_exception $e) {
            $success = false;
        }

        $stmt->close();
        return $success;
    }

  public function searchProfiles(string $keywords): array {
    $stmt = $this->db->prepare(
      "SELECT p.profile_id, p.profile_name, p.description, p.status,
          COUNT(u.id) AS user_count
       FROM user_profiles p
       LEFT JOIN user_accounts u ON u.profile = p.profile_name
       WHERE p.profile_name LIKE ? OR p.description LIKE ?
       GROUP BY p.profile_id, p.profile_name, p.description, p.status
       ORDER BY p.profile_name"
    );

    if (!$stmt) return [];

    $search = '%' . $keywords . '%';
    $stmt->bind_param('ss', $search, $search);

    $stmt->execute();
    $result = $stmt->get_result();

    $profiles = [];

    while ($row = $result->fetch_assoc()) {
      $profiles[] = $row;
    }

    $stmt->close();

    return $profiles;
  }
}