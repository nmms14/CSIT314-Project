<?php
require_once __DIR__ . '/../entity/UserProfile.php';

class viewUserProfileController {
    private UserProfile $up;

    public function __construct() {
        $this->up = new UserProfile();
    }

    public function viewUserProfiles(): array {
        return $this->up->getAllProfiles();
    }
}
