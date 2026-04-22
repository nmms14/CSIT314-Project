<?php
require_once __DIR__ . '/../config/DBConnection.php';

class UserAccount {
    private mysqli $db;

    public int $id;
    public string $name;
    public string $username;
    public string $email;
    public string $phone;
    public string $profile;
    public string $status;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function createAcc(string $name, string $username, string $email, string $phone, string $password, string $profile, string $status): bool {
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

	public function getProfiles() {
		$sql = "SELECT profile_name FROM user_profiles";
        return $this->db->query($sql);
	}
    
    // Converting the database row to object
	private function dbRowToUser(array $row): UserAccount {
		$user = new UserAccount($this->db);

		$user->id = $row['id'];
		$user->name = $row['name'];
		$user->username = $row['username'];
		$user->email = $row['email'];
		$user->phone = $row['phone_number'];
		$user->profile = $row['profile'];
		$user->status = $row['status'];

		return $user;
	}
	
	public function getAllAcc(): array {
		$sql = "SELECT id, name, username, email, phone_number, profile, status 
				FROM users";
		$result = $this->db->query($sql);
		
		$users = [];
		
		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$users[] = $this->dbRowToUser($row);
			}
		}
		
		return $users;
	}
	
	public function getAccDetail(string $username): ?UserAccount {
		$stmt = $this->db->prepare(
			"SELECT id, name, username, email, phone_number, profile, status 
			FROM users WHERE username = ? LIMIT 1"
		);
		
		 if (!$stmt) {
			return null;
		}

		$stmt->bind_param("s", $username);
		$stmt->execute();

		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		$stmt->close();

		if (!$row) return null;

		return $this->dbRowToUser($row);
	}

	public function searchAcc(string $keywords): array {
		$stmt = $this->db->prepare(
			"SELECT id, name, username, email, phone_number, profile, status 
			FROM users 
			WHERE username LIKE ? OR email LIKE ? OR profile = ? OR status = ?"
		);
		
		$search = '%' . $keywords . '%';
		$stmt->bind_param('ssss', $search, $search, $keywords, $keywords);
		$stmt->execute();
		
		$result = $stmt->get_result();
		$users = [];
		
		while ($row = $result->fetch_assoc()) {
			$users[] = $this->dbRowToUser($row);
		}
		
		return $users;
	}
}
?>
