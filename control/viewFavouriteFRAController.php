<?php
require_once __DIR__ . '/../entity/FavouriteFundraisingActivity.php';

class viewFavouriteFRAController {

    public function viewFavouriteFRA(string $username): array {
        $fav = new FavouriteFundraisingActivity();
        return $fav->viewFavouriteFRA($username);
    }
}