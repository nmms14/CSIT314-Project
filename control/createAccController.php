<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserAccount.php';

	class createAccController {
		public function createAcc(string $name, string $username, string $email, string $phone, string $password, string $profile): array {
			// required fields
			if ($name === '' || $username === '' || $email === '' || $password === '' || $profile === '') {
				return ['type' => 'error', 'message' => 'Please fill in all the required fields.'];
			}

			// email format
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return ['type' => 'error', 'message' => 'Invalid email format.'];
			}

			// phone (8 digits)
			if ($phone !== '' && !preg_match('/^[0-9]{8}$/', $phone)) {
				return ['type' => 'error', 'message' => 'Phone number should be 8 digits.'];
			}

			// password length
			if (strlen($password) < 6) {
				return ['type' => 'error', 'message' => 'Password should be at least 6 characters.'];
			}

			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);
			$status = 'Active';
			$success = $ua->createUser($name, $username, $email, $phone, $password, $profile, $status);

			if ($success) {
				return ['type' => 'success', 'message' => 'Account created successfully!'];
			}

			return ['type' => 'error', 'message' => 'Username already exists.'];
		}
	}
?>
