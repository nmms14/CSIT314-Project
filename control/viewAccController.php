<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserAccount.php';
	
	class viewAccController {
		public function __construct() {
			$db = DBConnection::getInstance();
			$this->ua = new UserAccount($db);
		}

		public function viewAccounts(): array {
			return $this->ua->getAllAcc();
		}

		public function viewAccountDetail(string $username): ?UserAccount {
			return $this->ua->getAccDetail($username);
		}
	}
?>	