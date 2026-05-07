<?php

require_once __DIR__ . '/../entity/Report.php';

class generateMonthlyReportController
{
    private Report $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function generateMonthlyReport(string $monthString): array
    {
        return $this->report->generateMonthlyReport($monthString);
    }
}
