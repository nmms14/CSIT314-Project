<?php

class dashboardUAPage
{
    public function display(): void
    {
        $username = $_SESSION['username'] ?? '';

        $pageTitle = 'Dashboard';
        $activePage = 'dashboard';
        $contentView = __DIR__ . '/views/dashboard_ua.view.php';

        include __DIR__ . '/views/layout_ua.view.php';
    }
}