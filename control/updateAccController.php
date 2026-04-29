<?php
	require_once __DIR__ . '/../entity/UserAccount.php';

	class updateAccController {
		public function updateAcc(string $currUsername, array $data): array {
			$ua = new UserAccount();

			$user = $ua->getAccDetail($currUsername);

			if (!$user) {
				return ['type' => 'error', 'message' => 'User not found.'];
			}

			if ($user->status === 'Suspended') {
				return ['type' => 'error', 'message' => 'Suspended users cannot be edited.'];
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
			$ua = new UserAccount();
			return $ua->getProfiles();
		}
		
		public function getAccDetail(string $username) {
			$ua = new UserAccount();
			return $ua->getAccDetail($username);
		}
	}
?>
