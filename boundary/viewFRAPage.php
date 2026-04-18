<?php
require_once __DIR__ . '/../control/viewFRAController.php';

class viewFRAPage
{
    public function display(): void
    {
        $controller = new viewFRAController();
        $data = $controller->getAll($_GET);

        $fraList = $data['fraList'] ?? [];

        $pageTitle = 'Dashboard';
        $activePage = 'view_fra';
        $contentView = __DIR__ . '/views/view_fra.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}