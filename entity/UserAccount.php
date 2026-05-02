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

    public function __construct() {
        $this->db = DBConnection::getInstance();
    }

	public function createAcc(string $name, string $username, string $email, string $phone, string $password, string $profile, string $status): array {
		if (!$this->isProfileActive($profile)) {
			return ['type' => 'error', 'message' => 'Selected profile is suspended or does not exist.'];
		}

		$stmt = $this->db->prepare(
			"INSERT INTO user_accounts (name, username, email, phone_number, password, profile, status) VALUES (?, ?, ?, ?, ?, ?, ?)"
		);

		if (!$stmt) return ['type' => 'error', 'message' => 'Failed to prepare statement.'];

		$stmt->bind_param('sssssss', $name, $username, $email, $phone, $password, $profile, $status);

		try {
			$success = $stmt->execute();
		} catch (mysqli_sql_exception $e) {
			return ['type' => 'error', 'message' => 'Username already exists.'];
		}

		$stmt->close();

		if ($success) {
			return ['type' => 'success', 'message' => 'Account created successfully!'];
		}

		return ['type' => 'error', 'message' => 'Failed to create account.'];
	}

	public function getProfiles() {
		$sql = "SELECT profile_name FROM user_profiles WHERE status = 'Active'";
        return $this->db->query($sql);
	}

	private function isProfileActive(string $profileName): bool {
		$stmt = $this->db->prepare(
			"SELECT 1 FROM user_profiles WHERE profile_name = ? AND status = 'Active' LIMIT 1"
		);
		if (!$stmt) return false;
		$stmt->bind_param('s', $profileName);
		$stmt->execute();
		$stmt->store_result();
		$ok = $stmt->num_rows > 0;
		$stmt->close();
		return $ok;
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
				FROM user_accounts";
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
			FROM user_accounts WHERE username = ? LIMIT 1"
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
			FROM user_accounts 
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

	public function updateAcc(string $username, array $data): array {
		$fields = [];
		$values = [];

		if (!empty($data['name'])) {
			$fields[] = "name = ?";
			$values[] = $data['name'];
		}

		if (!empty($data['username'])) {
			$fields[] = "username = ?";
			$values[] = $data['username'];
		}

		if (!empty($data['email'])) {
			$fields[] = "email = ?";
			$values[] = $data['email'];
		}

		if (!empty($data['phone'])) {
			$fields[] = "phone_number = ?";
			$values[] = $data['phone'];
		}

		if (!empty($data['password'])) {
			$fields[] = "password = ?";
			$values[] = $data['password'];
		}

		if (isset($data['profile']) && $data['profile'] !== '') {
			if (!$this->isProfileActive($data['profile'])) {
				return ['success' => false, 'message' => 'Selected profile is suspended or does not exist.'];
			}
			$fields[] = "profile = ?";
			$values[] = $data['profile'];
		}

		if (empty($fields)) {
			return false;
		}
		
		$sql = "UPDATE user_accounts SET " . implode(", ", $fields) . " WHERE username = ?";

		$values[] = $username;

		$stmt = $this->db->prepare($sql);

		if (!$stmt) {
			return [
				'success' => false,
				'message' => 'Prepare failed'
			];
		}

		$types = str_repeat("s", count($values));
		$stmt->bind_param($types, ...$values);

		if ($stmt->execute()) {
			return [
				'success' => true,
				'message' => 'Account updated successfully',
				'affected_rows' => $stmt->affected_rows
			];
		}

		return [
			'success' => false,
			'message' => 'Update failed'
		];
	}
	
	public function suspendAcc(string $username): bool {
		$stmt = $this->db->prepare(
			"UPDATE user_accounts SET status = 'Suspended' WHERE username = ?"
		);

		if (!$stmt) return false;

		$stmt->bind_param("s", $username);

		return $stmt->execute();
	}
}
?>
