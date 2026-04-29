<?php
	require_once __DIR__ . '/../entity/UserAccount.php';
	
	class viewAccController {
		public function __construct() {
			$this->ua = new UserAccount();
		}

		public function viewAccounts(): array {
			return $this->ua->getAllAcc();
		}

		public function viewAccountDetail(string $username): ?UserAccount {
			return $this->ua->getAccDetail($username);
		}
	}
?>	