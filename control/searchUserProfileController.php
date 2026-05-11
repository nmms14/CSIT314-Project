<?php
require_once __DIR__ . '/../entity/UserProfile.php';

class searchUserProfileController {
	
	public UserProfile $prof;
	
	public function __construct()
    {
        $this->prof = new UserProfile();
    }
	
    public function searchProfiles(string $keywords): array {
        return $this->prof->searchProfiles($keywords);
    }
}
?>