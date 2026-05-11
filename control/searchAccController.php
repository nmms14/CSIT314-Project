<?php
require_once __DIR__ . '/../entity/UserAccount.php';

class searchAccController {
	
	private UserAccount $ua;
	
	public function __construct() {
		$this->ua = new UserAccount();
	}
	
    public function searchAcc(string $keywords): array {
        return $this->ua->searchAcc($keywords);
    }
}
?>