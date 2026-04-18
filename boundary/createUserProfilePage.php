<?php
require_once __DIR__ . '/../control/createUserProfileController.php';

class createUserProfilePage
{
    public function clickCreateUserProfile(): void
    {
        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new createUserProfileController();
            $result = $controller->createUserProfile(
                $_POST['profile_name'] ?? '',
                $_POST['description']  ?? ''
            );

            $message     = $result['message'] ?? '';
            $messageType = $result['type'] ?? 'error';
        }

        $pageTitle   = 'Create User Profile';
        $activePage  = 'create_prof';
        $contentView = __DIR__ . '/views/create_prof.view.php';

        include __DIR__ . '/views/layout_ua.view.php';
    }
}
