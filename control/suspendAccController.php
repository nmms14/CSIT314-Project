<?php
	require_once __DIR__ . '/../entity/UserAccount.php';

	class suspendAccController {

		public function suspendAcc(string $username): bool {
			$ua = new UserAccount();
			return $ua->suspendAcc($username);
		}
	}

?>