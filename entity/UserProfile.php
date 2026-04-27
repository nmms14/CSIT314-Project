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

    public function updateProf(int $id, array $data): bool {
        $fields = [];
        $values = [];

        if (isset($data['profile_name'])) { $fields[] = "profile_name = ?"; $values[] = $data['profile_name']; }
        if (isset($data['description']))  { $fields[] = "description = ?";  $values[] = $data['description'];  }

        $values[] = $id;
        $stmt = $this->db->prepare(
            "UPDATE user_profiles SET " . implode(', ', $fields) . " WHERE profile_id = ?"
        );
        $types = str_repeat('s', count($values) - 1) . 'i';
        $stmt->bind_param($types, ...$values);

        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    public function getAllProfiles(): array {
        $sql = "SELECT p.profile_id, p.profile_name, p.description,
                       COUNT(u.id) AS user_count
                FROM user_profiles p
                LEFT JOIN user_accounts u ON u.profile = p.profile_name
                GROUP BY p.profile_id, p.profile_name, p.description
                ORDER BY p.profile_name";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
  
  public function searchProfiles(string $keywords): array {
    $stmt = $this->db->prepare(
      "SELECT p.profile_id, p.profile_name, p.description,
          COUNT(u.id) AS user_count
       FROM user_profiles p
       LEFT JOIN user_accounts u ON u.profile = p.profile_name
       WHERE p.profile_name LIKE ? OR p.description LIKE ?
       GROUP BY p.profile_id, p.profile_name, p.description
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