<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class viewNumFRAController
{
    public function getViewed(array $query = []): array
    {
        $fra = new FundraisingActivity();

        return $fra->getViewedFRA();
    }
}