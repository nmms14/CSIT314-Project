<?php
	require_once __DIR__ . '/../entity/UserAccount.php';

	class updateAccController {
		
		private UserAccount $ua;
	
		public function __construct() {
			$this->ua = new UserAccount();
		}
		
		public function updateAcc(string $currUsername, array $data): array {
			$user = $this->ua->getAccDetail($currUsername);

			if (!$user) {
				return ['type' => 'error', 'message' => 'User not found.'];
			}

			if ($user->status === 'Suspended') {
				return ['type' => 'error', 'message' => 'Suspended users cannot be edited.'];
			}

			$result = $this->ua->updateAcc($currUsername, $data);

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
			return $this->ua->getProfiles();
		}
		
		public function getAccDetail(string $username) {
			return $this->ua->getAccDetail($username);
		}
	}
?>
