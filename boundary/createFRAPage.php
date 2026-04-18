<?php
require_once __DIR__ . '/../control/createFRAController.php';

class createFRAPage
{
    public function handle(): void
    {
        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new createFRAController();
            $response = $controller->create($_POST, $_FILES);

            $message = $response['message'] ?? '';
            $messageType = $response['type'] ?? 'error';
        }

        $pageTitle = 'Dashboard';
        $activePage = 'create_fra';
        $contentView = __DIR__ . '/views/create_fra.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}