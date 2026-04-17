<?php

class PlatformManager {
    private mysqli $db;
    public ?int $id = null;
    public ?string $username = null;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function login(string $username, string $password): bool {
        $stmt = $this->db->prepare(
            "SELECT id, password FROM users WHERE username = ? AND profile = 'platform_manager' LIMIT 1"
        );
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $stored);

        if ($stmt->fetch() && hash_equals($stored, $password)) {
            $this->id = $id;
            $this->username = $username;
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }
}
