<?php
require_once __DIR__ . '/../control/viewUserProfileController.php';

class viewUserProfilePage {
    public function clickViewUserProfile(): void {
        $controller = new viewUserProfileController();
        $profiles = $controller->viewUserProfiles();

        $search = trim($_GET['search'] ?? '');
        if ($search !== '') {
            $needle = strtolower($search);
            $profiles = array_values(array_filter($profiles, function ($p) use ($needle) {
                return strpos(strtolower($p['profile_name']), $needle) !== false
                    || strpos(strtolower($p['description']), $needle) !== false;
            }));
        }

        $pageTitle   = 'User Profiles';
        $activePage  = 'view_prof';
        $contentView = __DIR__ . '/views/view_prof.view.php';

        include __DIR__ . '/views/layout_ua.view.php';
    }
}
