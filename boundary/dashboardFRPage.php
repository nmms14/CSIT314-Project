<?php

require_once __DIR__ . '/../control/dashboardFRController.php';

class dashboardFRPage
{
    public function display(): void
    {
        $username = $_SESSION['username'] ?? '';

        $dashboardController = new dashboardFRController();

        $dashboardData = $dashboardController->getDashboardData($username);

        $totalActiveFra = $dashboardData['totalActiveFra'];
        $totalGoal = $dashboardData['totalGoal'];
        $totalRaised = $dashboardData['totalRaised'];
        $averageProgress = $dashboardData['averageProgress'];
        $activeFras = $dashboardData['activeFras'];
        $recentActivities = $dashboardData['recentActivities'];

        $pageTitle = 'Dashboard';
        $activePage = 'dashboard';

        $contentView = __DIR__ . '/views/dashboard_frhome.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}