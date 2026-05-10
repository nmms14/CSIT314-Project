<?php

require_once __DIR__ . '/../control/dashboardUAController.php';

class dashboardUAPage
{
    private dashboardUAController $controller;

    public function __construct()
    {
        $this->controller =
            new dashboardUAController();
    }

    public function display(): void
    {
        $username = $_SESSION['username'] ?? '';

        $totalUsers = $this->controller->getTotalUsers();

        $suspendedAccounts = $this->controller->getSuspendedAccounts();

        $activeAccounts = $this->controller->getActiveAccounts();

        $totalProfiles = $this->controller->getTotalProfiles();

        $newUsers = $this->controller->getNewUsers();

        $recentAccounts = $this->controller->getRecentAccounts();

        $pageTitle = 'Dashboard';

        $activePage = 'dashboard';

        $contentView =
            __DIR__ .
            '/views/dashboard_ua.view.php';

        include __DIR__ .
                '/views/layout_ua.view.php';
    }
}