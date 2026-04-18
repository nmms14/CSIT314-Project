<?php
require_once __DIR__ . '/../config/DBConnection.php';

class UserAccount {
    private mysqli $db;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function createUser(string $name, string $username, string $email, string $phone, string $password, string $profile, string $status): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, username, email, phone_number, password, profile, status) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        if (!$stmt) return false;

        $stmt->bind_param('sssssss', $name, $username, $email, $phone, $password, $profile, $status);

        try {
            $success = $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }

        $stmt->close();
        return $success;
    }
}
?>