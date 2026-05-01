<?php
require_once __DIR__ . '/../config/DBConnection.php';
require_once __DIR__ . '/../entity/UserProfile.php';

class updateProfController {
    public function updateProf(int $profile_id, string $profile_name, string $description): array {
        if ($profile_name === '' || $description === '') {
            return ['type' => 'error', 'message' => 'All fields are required.'];
        }

        $db      = DBConnection::getInstance();
        $up      = new UserProfile($db);
        $updated = $up->updateProf($profile_id, $profile_name, $description);

        if (!empty($updated)) {
            return ['type' => 'success', 'message' => 'Profile updated successfully!'];
        }

        return ['type' => 'error', 'message' => 'Unable to update profile.'];
    }
}
?>