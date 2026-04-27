<?php
require_once __DIR__ . '/../entity/UserProfile.php';
require_once __DIR__ . '/../config/DBConnection.php';

class searchUserProfileController {
    public function searchProfiles(string $keywords): array {
        $db = DBConnection::getInstance();
        $prof = new UserProfile($db);
        return $prof->searchProfiles($keywords);
    }
}
?>