<?php
require_once __DIR__ . '/../entity/UserProfile.php';

class updateProfController {
    public function updateProf(int $profile_id, string $profile_name, string $description): array {
        if ($profile_name === '' || $description === '') {
            return ['type' => 'error', 'message' => 'All fields are required.'];
        }

        $up      = new UserProfile();
        $updated = $up->updateProf($profile_id, $profile_name, $description);

        if (!empty($updated)) {
            return ['type' => 'success', 'message' => 'Profile updated successfully!'];
        }

        return ['type' => 'error', 'message' => 'Unable to update profile.'];
    }
}
?>