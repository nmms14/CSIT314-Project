<?php
require_once __DIR__ . '/../config/DBConnection.php';
require_once __DIR__ . '/../entity/UserProfile.php';

class SuspendProfileController {

    public function suspendUserProfile(int $profileID): bool {
        if ($profileID <= 0) return false;

        $db = DBConnection::getInstance();
        $up = new UserProfile($db);

        return $up->suspendUserProfile($profileID);
    }
}
