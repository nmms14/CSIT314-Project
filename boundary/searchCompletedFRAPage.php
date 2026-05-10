<?php

require_once __DIR__ . '/../control/searchCompletedFRAController.php';

class searchCompletedFRAPage
{
    public function search(): void
    {
        $controller = new searchCompletedFRAController();

        $keyword = trim($_GET['keyword'] ?? '');

        $fraList = $controller->getCompleted([
            'keyword' => $keyword
        ]);

        $pageTitle = 'View Completed';
        $activePage = 'view_completed';
        $contentView = __DIR__ . '/views/view_completed_fra.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}