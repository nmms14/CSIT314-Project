<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserAdmin.php';

	class createAccController {
		 public function createAcc(string $name, string $username, string $email, string $phone, string $password, string $profile): bool {
			 $db = DBConnection::getInstance();
			 $ua = new UserAdmin($db);
			 return $ua->createUser($name, $username, $email, $phone, $password, $profile);
		 }

		public function validateInput(string $name, string $username, string $email, string $phone, string $password, string $profile): bool {
			 // required fields
			if ($name === '' || $username === '' || $email === '' || $password === '' || $profile === '') {
				return false;
			}

			// email format
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return false;
			}

			// phone (8 digits)
			if ($phone !== '' && !preg_match('/^[0-9]{8}$/', $phone)) {
				return false;
			}

			// password length
			if (strlen($password) < 6) {
				return false;
			}

			return true;
		}
	}
?>
