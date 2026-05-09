<?php

require_once __DIR__ . '/../control/viewDNFRAController.php';
require_once __DIR__ . '/../control/donateFRAController.php';

class viewDNFRAPage
{
    private viewDNFRAController $controller;
	private donateFRAController $donateController;

    public function __construct()
    {
        $this->controller = new viewDNFRAController();
		$this->donateController = new donateFRAController();
    }

    public function render(): void
    {
        $fraId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $fra = $this->controller->getFRADetails($fraId);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$amount = (float) $_POST['amount'];

			$success = $this->donateController->donateToFRA($fra['id'],$_SESSION['username'],$amount);

			if (!$success) {
				$popupMessage =
					"Donation amount exceeds goal amount.";
				$popupType = "error";
			}
		}

        $contentView = __DIR__ . '/views/view_dn_fra.view.php';

        include __DIR__ . '/views/layout_dn.view.php';
    }
}

$page = new viewDNFRAPage();
$page->render();