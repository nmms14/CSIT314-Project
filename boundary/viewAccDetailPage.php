<?php
	require_once __DIR__ . '/../entity/UserAccount.php';
	require_once __DIR__ . '/../control/viewAccController.php';
	require_once __DIR__ . '/../control/suspendAccController.php';

	class ViewAccDetailPage
	{
		public function display(): void
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'suspend') {

				$username = $_POST['username'] ?? '';

				$ua = new UserAccount();
				$user = $ua->getAccDetail($username);

				if (!$user) {
					$type = 'error';
					$msg = 'Account not found.';
				}
				elseif ($user->status === 'Suspended') {
					$type = 'error';
					$msg = 'Account already suspended.';
				}
				else {
					$controller = new suspendAccController();
					$success = $controller->suspendAcc($username);

					if ($success) {
						$type = 'success';
						$msg = 'Account suspended successfully.';
					} else {
						$type = 'error';
						$msg = 'Unable to suspend user.';
					}
				}

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