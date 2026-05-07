<?php

require_once __DIR__ . '/../entity/Report.php';

class generateDailyReportController
{
    private Report $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function generateDailyReport(string $dayString): array
    {
        return $this->report->generateDailyReport($dayString);
    }
}
