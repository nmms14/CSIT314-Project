<?php

require_once __DIR__ . '/Report.php';

class dashboardPMEntity
{
    private Report $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function getDailySummary(string $dayString): array
    {
        return $this->report->generateDailyReport($dayString);
    }

    public function getWeeklySummary(string $weekStartString): array
    {
        return $this->report->generateWeeklyReport($weekStartString);
    }

    public function getMonthlySummary(string $monthString): array
    {
        return $this->report->generateMonthlyReport($monthString);
    }
}
