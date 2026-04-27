<?php
require_once __DIR__ . '/../control/updateAccController.php';

	class updateAccPage
	{
		public function display(): void
		{
			$message = '';
			$messageType = '';
			
			$controller = new updateAccController();
			$currUsername = $_POST['currUsername'] ?? $_GET['username'] ?? null;
			
			if (!$currUsername) {
				die("No username provided.");
			}

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$result = $controller->updateAcc(
					$currUsername,
					$_POST['name']     ?? '',
					$_POST['username'] ?? '',
					$_POST['email']    ?? '',
					$_POST['phone']    ?? '',
					$_POST['password'] ?? '',
					$_POST['profile']  ?? ''
				);
				
				$message     = $result['message'] ?? '';
				$messageType = $result['type'] ?? 'error';
				
				if ($messageType === 'success') {
					// if username was changed, use new one
					$newUsername = !empty($_POST['username']) 
						? $_POST['username'] 
						: $currUsername;

					header("Location: view_acc_detail.php?username=" . urlencode($newUsername) . "&success=1");
					exit;
				}
			}

			$user = $controller->getAccDetail($currUsername);
			$profiles = $controller->loadProfiles();
			
			if (!$user) {
				die("User not found.");
			}
			
			$pageTitle   = 'Dashboard';
			$activePage  = 'view_accounts';
			$contentView = __DIR__ . '/views/update_account.view.php';

			include __DIR__ . '/views/layout_ua.view.php';
		}
	}
?>