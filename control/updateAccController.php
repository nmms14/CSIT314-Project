<?php
	require_once __DIR__ . '/../entity/UserAccount.php';

	class updateAccController {
		
		private UserAccount $ua;
	
		public function __construct() {
			$this->ua = new UserAccount();
		}
		
		public function updateAcc(string $currUsername, array $data): array {
			return $this->ua->updateAcc($currUsername, $data);
		}

		public function loadProfiles() {
			return $this->ua->getProfiles();
		}
		
		public function getAccDetail(string $username) {
			return $this->ua->getAccDetail($username);
		}
	}
?>
