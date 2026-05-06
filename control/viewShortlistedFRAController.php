<?php

require_once __DIR__ . '/../entity/FavouriteFundraisingActivity.php';

class viewShortlistedFRAController
{
    public function getShortlisted(array $query = []): array
    {
        $favourite = new FavouriteFundraisingActivity();

        return $favourite->getShortlistedFRA();
    }
}