<?php

require_once __DIR__ . '/../entity/dashboardPMEntity.php';

class dashboardPMController
{
    private dashboardPMEntity $dashboard;

    public function __construct()
    {
        $this->dashboard = new dashboardPMEntity();
    }

    public function getDailySummary(string $dayString): array
    {
        return $this->dashboard->getDailySummary($dayString);
    }

    public function getWeeklySummary(string $weekStartString): array
    {
        return $this->dashboard->getWeeklySummary($weekStartString);
    }

    public function getMonthlySummary(string $monthString): array
    {
        return $this->dashboard->getMonthlySummary($monthString);
    }
}
