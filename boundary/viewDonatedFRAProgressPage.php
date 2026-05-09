<?php

require_once __DIR__ . '/../control/viewDonatedFRAProgressController.php';

class viewDonatedFRAProgressPage
{
    private viewDonatedFRAProgressController $controller;

    public function __construct()
    {
        $this->controller = new viewDonatedFRAProgressController();
    }

    public function display(): void
    {
        $results =
            $this->controller->viewDonatedFRA($_SESSION['username']);

        $contentView =  __DIR__ . '/views/view_donate_progress.view.php';

        include __DIR__ . '/views/layout_dn.view.php';
    }
}

$page = new viewDonatedFRAProgressPage();
$page->display();