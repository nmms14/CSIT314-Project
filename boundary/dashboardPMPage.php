<?php

class dashboardPMPage
{
    public function display(): void
    {
        $username = $_SESSION['username'] ?? '';

        $pageTitle = 'Dashboard';
        $activePage = 'dashboard';
        $contentView = __DIR__ . '/views/dashboard_pm.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }
}