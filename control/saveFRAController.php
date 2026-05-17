<?php

require_once __DIR__ . '/../entity/FavouriteFundraisingActivity.php';

class saveFRAController
{
    private FavouriteFundraisingActivity $favouriteFRA;

    public function __construct()
    {
        $this->favouriteFRA = new FavouriteFundraisingActivity();
    }

    public function saveFavouriteFRA(string $username, int $fraId): bool
    {
        return $this->favouriteFRA->saveFavouriteFRA($username, $fraId);
    }
}