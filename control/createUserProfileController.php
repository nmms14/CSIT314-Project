<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserProfile.php';

	class createUserProfileController {
		public function createUserProfile(string $profileName, string $description): array {
			// required fields
			if ($profileName === '' || $description === '') {
				return ['type' => 'error', 'message' => 'Please fill in all the required fields.'];
			}

			// profile name must be one of the allowed roles
			$allowed = ['platform_manager', 'donee', 'fund_raiser', 'user_admin'];
			if (!in_array($profileName, $allowed, true)) {
				return ['type' => 'error', 'message' => 'Invalid profile name.'];
			}

			$db = DBConnection::getInstance();
			$up = new UserProfile($db);
			$success = $up->createUserProfile($profileName, $description);

			if ($success) {
				return ['type' => 'success', 'message' => 'User profile created successfully!'];
			}

			return ['type' => 'error', 'message' => 'Profile name already exists.'];
		}
	}
?>
