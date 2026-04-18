<?php

class dashboardFRPage
{
    public function display(): void
    {
        $username = $_SESSION['username'] ?? '';
        $pageTitle = 'Dashboard';
        $activePage = '';
        $contentView = __DIR__ . '/views/dashboard_home.view.php';

        include __DIR__ . '/views/dashboard_frhome.view.php';
    }
}