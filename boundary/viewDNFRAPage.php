<?php

require_once __DIR__ . '/../control/viewDNFRAController.php';

class viewDNFRAPage
{
    private viewDNFRAController $controller;

    public function __construct()
    {
        $this->controller = new viewDNFRAController();
    }

    public function render(): void
    {
        $fraId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $fra = $this->controller->getFRADetails($fraId);

        $contentView = __DIR__ . '/views/view_dn_fra.view.php';

        include __DIR__ . '/views/layout_dn.view.php';
    }
}

$page = new viewDNFRAPage();
$page->render();