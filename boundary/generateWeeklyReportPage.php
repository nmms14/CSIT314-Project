<?php

require_once __DIR__ . '/../control/generateWeeklyReportController.php';

class generateWeeklyReportPage
{
    private generateWeeklyReportController $controller;
    private string $weekStartString = '';
    private ?array $report = null;
    private string $errorMessage = '';

    public function __construct()
    {
        $this->controller = new generateWeeklyReportController();
    }

    public function display(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->weekStartString = trim($_POST['week_start'] ?? '');

            if ($this->weekStartString === '') {
                $this->errorMessage = 'Please select a start date.';
            } elseif (!$this->isValidDate($this->weekStartString)) {
                $this->errorMessage = 'Invalid date format. Use YYYY-MM-DD.';
            } else {
                $this->report = $this->controller->generateWeeklyReport($this->weekStartString);
            }
        }

        $weekStartString = $this->weekStartString;
        $report = $this->report;
        $errorMessage = $this->errorMessage;

        $activePage = 'weekly_report';
        $pageTitle = $this->report ? 'Weekly Report' : 'Generate Weekly Report';

        $contentView = $this->report
            ? __DIR__ . '/views/weekly_report_output.view.php'
            : __DIR__ . '/views/weekly_report_input.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }

    private function isValidDate(string $value): bool
    {
        $d = DateTime::createFromFormat('Y-m-d', $value);
        return $d && $d->format('Y-m-d') === $value;
    }
}
