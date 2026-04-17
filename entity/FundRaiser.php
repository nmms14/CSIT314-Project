<?php

class FundRaiser {
    private mysqli $db;
    public ?int $id = null;
    public ?string $username = null;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

public function login(string $username, string $password): bool {
    $stmt = $this->db->prepare(
        "SELECT id, password, role FROM users WHERE username = ? LIMIT 1"
    );

    if (!$stmt) {
        die("Prepare failed: " . $this->db->error);
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($id, $stored, $role);

    if ($stmt->fetch()) {
        echo "User found<br>";
        echo "Role in DB: " . $role . "<br>";
        echo "DB password: " . $stored . "<br>";
        echo "Input password: " . $password . "<br>";

        if ($role !== 'fundraiser') {
            die("Role mismatch");
        }

        if ($stored === $password) {
            die("LOGIN SUCCESS (password correct)");
        } else {
            die("Password mismatch");
        }
    } else {
        die("No user found");
    }
}
}