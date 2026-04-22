<?php
require_once __DIR__ . '/../control/updateAccController.php';

class updateAccPage
{
    public function handle(): void
    {
        $message = '';
        $messageType = '';
		
		$controller = new updateAccController();
		$id = $_POST['id'] ?? $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $controller->updateAcc(
				(int)$id,
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

		$user = $controller->getUserById((int)$id);
		
		$pageTitle   = 'Dashboard';
		$activePage  = 'view_accounts';
		$contentView = __DIR__ . '/views/update_account.view.php';

		include __DIR__ . '/views/layout_ua.view.php';
    }
}
?>