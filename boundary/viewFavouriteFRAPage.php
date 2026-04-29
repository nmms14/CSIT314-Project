<?php
require_once __DIR__ . '/../control/viewFavouriteFRAController.php';

class ViewFavouritePage {

    public function viewFRA(): void {

        $controller = new viewFavouriteFRAController();

        // get current user (donee)
        $username = $_SESSION['username'] ?? null;

        if (!$username) {
            die("No username provided.");
        }

        // get favourite activities
        $activities = $controller->viewFavouriteFRA($username);

        // page setup
        $pageTitle = 'Favourite Fundraising Activities';
        $activePage = 'favourite_fra';

        $contentView = __DIR__ . '/views/view_favourite_fra.view.php';

        include __DIR__ . '/views/layout_dn.view.php';
    }
}