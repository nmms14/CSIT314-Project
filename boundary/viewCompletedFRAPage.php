<?php

require_once __DIR__ . '/../control/viewCompletedFRAController.php';

class viewCompletedFRAPage
{
    private viewCompletedFRAController $controller;

    public function __construct()
    {
        $this->controller = new viewCompletedFRAController();
    }

    public function display(): void
    {
        $results =
            $this->controller
                 ->viewCompletedFRA();

        $contentView = __DIR__ . '/views/view_completed_fra.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}

$page = new viewCompletedFRAPage();

$page->display();