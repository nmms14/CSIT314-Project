<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserAccount.php';

	class updateAccController {
		public function updateAcc(
			string $currUsername, string $name = '', string $username = '', string $email = '', string $phone = '', string $password = '', string $profile = ''): array {

			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);

			$user = $ua->getAccDetail($currUsername);

			if (!$user) {
				return ['type' => 'error', 'message' => 'User not found.'];
			}

			if ($user->status === 'suspended') {
				return ['type' => 'error', 'message' => 'Suspended users cannot be edited.'];
			}

			$data = [];

			if ($name !== '')        $data['name'] = $name;
			if ($username !== '')    $data['username'] = $username;
			if ($email !== '')       $data['email'] = $email;
			if ($phone !== '')       $data['phone'] = $phone;
			if ($password !== '')    $data['password'] = $password;
			if ($profile !== '')     $data['profile'] = $profile;

			if (empty($data)) {
				return ['type' => 'error', 'message' => 'Please update at least one field.'];
			}
			
			$isSame = true;

			foreach ($data as $key => $value) {
				if ($user->$key != $value) {
					$isSame = false;
					break;
				}
			}

			if ($isSame) {
				return ['type' => 'error', 'message' => 'No changes detected.'];
			}

			// Validation
			if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				return ['type' => 'error', 'message' => 'Invalid email format.'];
			}

			if (isset($data['phone']) && !preg_match('/^[0-9]{8}$/', $data['phone'])) {
				return ['type' => 'error', 'message' => 'Phone number should be 8 digits.'];
			}

			if (isset($data['password']) && strlen($data['password']) < 6) {
				return ['type' => 'error', 'message' => 'Password should be at least 6 characters.'];
			}

			$result = $ua->updateAcc($currUsername, $data);

			if ($result['success']) {
				return [
					'type' => 'success',
					'message' => $result['message']
				];
			}

			return [
				'type' => 'error',
				'message' => $result['message']
			];
		}

		public function loadProfiles() {
			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);
			return $ua->getProfiles();
		}
		
		public function getAccDetail(string $username) {
			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);
			return $ua->getAccDetail($username);
		}
	}
?>
