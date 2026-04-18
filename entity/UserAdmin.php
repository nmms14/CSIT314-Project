<?php

class UserAdmin {
    private mysqli $db;
    public ?int $id = null;
    public ?string $username = null;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function login(string $username, string $password): bool {
        $stmt = $this->db->prepare(
            "SELECT id, password FROM users WHERE username = ? AND profile = 'user_admin' LIMIT 1"
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

    public function createUser(string $name, string $username, string $email, string $phone, string $password, string $profile): bool {
		$stmt = $this->db->prepare(
			"INSERT INTO users (name, username, email, phone_number, password, profile) VALUES (?, ?, ?, ?, ?, ?)"
		);
		
		if (!$stmt) {
			return false; // return false when prepare failed
		}
		
		$stmt->bind_param('ssssss', $name, $username, $email, $phone, $password, $profile);

		try {
			$success = $stmt->execute();	// $success is boolean
		} catch (mysqli_sql_exception $e) {
			return false;
		}

		$stmt->close();

		return $success;
	}
}
