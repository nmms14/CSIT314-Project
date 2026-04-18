<?php
	require_once __DIR__ . '/../control/viewAccController.php';

	class ViewAccDetailPage
	{
		public function display(): void
		{
			$controller = new viewAccController();

			$username = $_GET['username'] ?? '';
			$user = $controller->viewAccountDetail($username);

			$pageTitle = 'User Details';
			$activePage = 'view_accounts';

			$contentView = __DIR__ . '/views/view_account_details.view.php';

			include __DIR__ . '/views/layout_ua.view.php';
		}
	}

	$page = new viewAccDetailPage();
	$page->display();
?>