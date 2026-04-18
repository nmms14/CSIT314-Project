<?php
require_once __DIR__ . '/../control/createAccController.php';

class createAccPage
{
    public function handle(): void
    {
        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new createAccController();
            $result = $controller->createAcc(
                $_POST['name']     ?? '',
                $_POST['username'] ?? '',
                $_POST['email']    ?? '',
                $_POST['phone']    ?? '',
                $_POST['password'] ?? '',
                $_POST['profile']  ?? ''
            );
			
            $message     = $result['message'] ?? '';
            $messageType = $result['type'] ?? 'error';
        }

		$pageTitle   = 'Dashboard';
		$activePage  = 'create_acc';
		$contentView = __DIR__ . '/views/create_account.view.php';

		include __DIR__ . '/views/layout_ua.view.php';
    }
}