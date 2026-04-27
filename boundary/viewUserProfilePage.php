<?php
require_once __DIR__ . '/../control/viewUserProfileController.php';
require_once __DIR__ . '/../control/searchUserProfileController.php';

class viewUserProfilePage {
    public function clickViewUserProfile(): void {
        $controller = new viewUserProfileController();
        $profiles = $controller->viewUserProfiles();

        $keywords = trim($_GET['keywords'] ?? '');

    if ($keywords !== '') {
      $searchController = new searchUserProfileController();
      $profiles = $searchController->searchProfiles($keywords);
    } else {
      $profiles = $controller->viewUserProfiles();
    }

        $pageTitle   = 'User Profiles';
        $activePage  = 'view_prof';
        $contentView = __DIR__ . '/views/view_prof.view.php';

        include __DIR__ . '/views/layout_ua.view.php';
    }
}