<?php

require_once __DIR__ . '/../entity/Report.php';

class generateWeeklyReportController
{
    private Report $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function generateWeeklyReport(string $weekStartString): array
    {
        return $this->report->generateWeeklyReport($weekStartString);
    }
}
