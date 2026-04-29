<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class viewFRAController
{
    public function getAll(): array
    {
        $db = DBConnection::getInstance();

        $fra = new FundraisingActivity($db);

        $fraList = $fra->getAllFRA();

        return [
            'fraList' => $fraList
        ];
    }
}