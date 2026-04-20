<?php
require_once __DIR__ . '/../control/createUserProfileController.php';

class createUserProfilePage {
    public function clickCreateUserProfile(): void {
        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profileName = trim($_POST['profile_name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            $controller = new createUserProfileController();
            $success = $controller->createUserProfile($profileName, $description);

            if ($success) {
                $message = 'User profile created successfully.';
                $messageType = 'success';
            } else {
                $message = 'Failed to create user profile. Check inputs or duplicate profile.';
                $messageType = 'error';
            }
        }

        $pageTitle = 'Create User Profile';
        $activePage = 'view_prof';
        $contentView = __DIR__ . '/views/create_prof.view.php';

        include __DIR__ . '/views/layout_ua.view.php';
    }
}
