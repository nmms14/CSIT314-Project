<?php

require_once __DIR__ . '/../control/dashboardPMController.php';

class dashboardPMPage
{
    private dashboardPMController $controller;

    public function __construct()
    {
        $this->controller = new dashboardPMController();
    }

    public function display(): void
    {
        $username = $_SESSION['username'] ?? '';

        $today       = date('Y-m-d');
        $weekStart   = date('Y-m-d', strtotime('monday this week'));
        $weekEnd     = date('Y-m-d', strtotime($weekStart . ' +6 days'));
        $monthString = date('Y-m');

        $dailyReport   = $this->controller->getDailySummary($today);
        $weeklyReport  = $this->controller->getWeeklySummary($weekStart);
        $monthlyReport = $this->controller->getMonthlySummary($monthString);

        $pageTitle  = 'Dashboard';
        $activePage = 'dashboard';
        $contentView = __DIR__ . '/views/dashboard_pm.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }
}
