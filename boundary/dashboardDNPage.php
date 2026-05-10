<?php

require_once __DIR__ . '/../control/dashboardDNController.php';

class dashboardDNPage
{
    public function display(): void
    {
        $username = $_SESSION['username'] ?? '';

        $dashboardController = new dashboardDNController();
        $dashboardData = $dashboardController->getDashboardData($username);

        $totalDonations = $dashboardData['totalDonations'];
        $totalAmount = $dashboardData['totalAmount'];
        $savedFraCount = $dashboardData['savedFraCount'];
        $recentDonations = $dashboardData['recentDonations'];
        $savedCampaigns = $dashboardData['savedCampaigns'];
        $trendingCampaigns = $dashboardData['trendingCampaigns'];

        $activePage = 'dashboard';
        $pageTitle = 'Dashboard';
        $contentView = __DIR__ . '/views/dashboard_dn.view.php';

        include __DIR__ . '/views/layout_dn.view.php';
    }
}