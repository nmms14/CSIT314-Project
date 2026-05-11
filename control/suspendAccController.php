<?php
	require_once __DIR__ . '/../entity/UserAccount.php';

	class suspendAccController {
		
		private UserAccount $ua;
	
		public function __construct() {
			$this->ua = new UserAccount();
		}
		
		public function suspendAcc(string $username): bool {
			return $this->ua->suspendAcc($username);
		}
	}

?>