<?php
	require_once __DIR__ . '/../control/ViewAccController.php';
	require_once __DIR__ . '/../control/searchAccController.php';

	class ViewAccPage
	{
		public function display(): void
		{
			$controller = new ViewAccController();
			$keywords = trim($_GET['keywords'] ?? '');

			if ($keywords !== '') {
				$searchController = new searchAccController();
				$users = $searchController->searchAcc($keywords);
			} else {
				$users = $controller->viewAccounts();
			}

			$pageTitle = 'User Accounts';
			$activePage = 'view_accounts';

			$contentView = __DIR__ . '/views/view_account.view.php';

			include __DIR__ . '/views/layout_ua.view.php';
		}
	}

	$page = new ViewAccPage();
	$page->display();
?>