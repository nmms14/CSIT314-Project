<?php
	require_once __DIR__ . '/../control/viewAccController.php';
	require_once __DIR__ . '/../control/suspendAccController.php';

	class ViewAccDetailPage
	{
		public function display(): void
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'suspend') {

				$controller = new suspendAccController();
				$result = $controller->suspendAcc($_POST['username']);

				$msg = urlencode($result['message']);
				$type = $result['type'];

				header("Location: view_acc_detail.php?username=" . urlencode($_POST['username']) . "&type=$type&msg=$msg");
				exit;
			}
		
			$controller = new viewAccController();
			
			$username = $_GET['username'] ?? null;

			if (!$username) {
				die("No username provided.");
			}

			$user = $controller->viewAccountDetail($username);

			if (!$user) {
				die("User not found.");
			}

			$pageTitle = 'User Details';
			$activePage = 'view_accounts';

			$contentView = __DIR__ . '/views/view_account_details.view.php';

			include __DIR__ . '/views/layout_ua.view.php';
		}
	}
?>