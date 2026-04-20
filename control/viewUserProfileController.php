<?php
require_once __DIR__ . '/../config/DBConnection.php';
require_once __DIR__ . '/../entity/UserProfile.php';

class viewUserProfileController {
    private UserProfile $up;

    public function __construct() {
        $db = DBConnection::getInstance();
        $this->up = new UserProfile($db);
    }

    public function viewUserProfiles(): array {
        return $this->up->getAllProfiles();
    }
}
