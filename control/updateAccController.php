<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserAccount.php';

	class updateAccController {
		public function updateAcc(int $id, string $name = '', string $username = '', string $email = '', string $phone = '', string $password = '', string $profile = ''): array {

			$data = [];

			if ($name !== '')        $data['name'] = $name;
			if ($username !== '')    $data['username'] = $username;
			if ($email !== '')       $data['email'] = $email;
			if ($phone !== '')       $data['phone'] = $phone;
			if ($password !== '')    $data['password'] = $password;
			if ($profile !== '')     $data['profile'] = $profile;
			
			// Admin must at least update one field
			if (empty($data)) {
				return ['type' => 'error', 'message' => 'Please update at least one field.'];
			}

			// Validation only for fields admin typed
			if (isset($data['email']) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return ['type' => 'error', 'message' => 'Invalid email format.'];
			}

			if (isset($data['phone']) && !preg_match('/^[0-9]{8}$/', $phone)) {
				return ['type' => 'error', 'message' => 'Phone number should be 8 digits.'];
			}

			if (isset($data['password']) && strlen($password) < 6) {
				return ['type' => 'error', 'message' => 'Password should be at least 6 characters.'];
			}

			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);
			$success = $ua->updateAcc($id, $data);

			if ($success) {
				return ['type' => 'success', 'message' => 'Account updated successfully!'];
			}

			return ['type' => 'error', 'message' => 'Unable to update account.'];
		}

		public function loadProfiles() {
			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);
			return $ua->getProfiles();
		}
		
		public function getUserById(int $id) {
			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);
			return $ua->getUserById($id);
		}
	}
?>
