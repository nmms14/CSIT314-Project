<?php
require_once __DIR__ . '/../entity/FundraisingActivity.php';
require_once __DIR__ . '/../config/DBConnection.php';

class viewFRAController
{
    public function getAll(array $query): array
    {
        $db = DBConnection::getInstance();
        $fra = new FundraisingActivity($db);

        $fundRaiserId = (int)($_SESSION['user_id'] ?? 0);

        $fraList = $fra->getAllFRA();

        return [
            'fraList' => $fraList
        ];
    }
}