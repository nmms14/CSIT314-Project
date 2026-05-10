<?php
require_once __DIR__ . '/../entity/UserProfile.php';

class SuspendProfileController {

    public function suspendUserProfile(int $profileID): bool {
        if ($profileID <= 0) return false;

        $up = new UserProfile();

        return $up->suspendUserProfile($profileID);
    }
}
