<?php
require_once __DIR__ . '/../config/DBConnection.php';
require_once __DIR__ . '/../entity/UserProfile.php';

class createUserProfileController {
    private UserProfile $up;

    public function __construct() {
        $db = DBConnection::getInstance();
        $this->up = new UserProfile($db);
    }

    public function createUserProfile(string $profileName, string $description): bool {
        if ($profileName === '' || $description === '') {
            return false;
        }

        return $this->up->createUserProfile($profileName, $description);
    }
}
