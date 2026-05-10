<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class searchCompletedFRAController
{
    public function getCompleted(array $query = []): array
    {
        $fra = new FundraisingActivity();

        return $fra->getCompletedFRA($query);
    }
}