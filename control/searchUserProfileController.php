<?php
require_once __DIR__ . '/../entity/UserProfile.php';

class searchUserProfileController {
    public function searchProfiles(string $keywords): array {
        $prof = new UserProfile();
        return $prof->searchProfiles($keywords);
    }
}
?>