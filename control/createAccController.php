<?php
require_once __DIR__ . '/../entity/UserAccount.php';

class createAccController {
	
	private UserAccount $ua;
	
	public function __construct() {
		$this->ua = new UserAccount();
	}
	
	public function createAcc(string $name, string $username, string $email, string $phone, string $password, string $profile): array {
		$status = 'Active';
		return $this->ua->createAcc($name, $username, $email, $phone, $password, $profile, 'Active');
	}

	public function loadProfiles() {
		$ua = new UserAccount();
		return $this->ua->getProfiles();
	}
}
?>
