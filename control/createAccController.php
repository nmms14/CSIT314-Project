<?php
	require_once __DIR__ . '/../entity/UserAccount.php';

	class createAccController {
		public function createAcc(string $name, string $username, string $email, string $phone, string $password, string $profile): array {
			$ua = new UserAccount();
			$status = 'Active';
			return $ua->createAcc($name, $username, $email, $phone, $password, $profile, 'Active');
		}

		public function loadProfiles() {
			$ua = new UserAccount();
			return $ua->getProfiles();
		}
	}
?>
