<?php

require_once __DIR__ . '/../entity/FavouriteFundraisingActivity.php';

class searchFavouriteFRAController
{
    private FavouriteFundraisingActivity $favouriteFRA;

    public function __construct()
    {
        $this->favouriteFRA = new FavouriteFundraisingActivity();
    }

    public function searchFavouriteFRAid(string $keywords): array
    {
        $username = $_SESSION['username'] ?? '';

        if ($username === '') {
            return [];
        }

        $keywords = trim($keywords);

        if ($keywords === '') {
            return $this->favouriteFRA->viewFavouriteFRA($username);
        }

        return $this->favouriteFRA->searchFavouriteFRAid($keywords, $username);
    }
}
