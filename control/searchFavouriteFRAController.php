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

        return $this->favouriteFRA->searchFavouriteFRAid(trim($keywords), $username);
    }
}
