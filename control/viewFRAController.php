<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class viewFRAController
{
    public function getAll(): array
    {
        $fra = new FundraisingActivity();

        $fraList = $fra->getAllFRA();

        return [
            'fraList' => $fraList
        ];
    }
}