<?php

require_once __DIR__ . '/../control/generateDailyReportController.php';

class generateDailyReportPage
{
    private generateDailyReportController $controller;
    private string $dayString = '';
    private ?array $report = null;
    private string $errorMessage = '';

    public function __construct()
    {
        $this->controller = new generateDailyReportController();
    }

    public function display(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->dayString = trim($_POST['day'] ?? '');

            if ($this->dayString === '') {
                $this->errorMessage = 'Please select a date.';
            } elseif (!$this->isValidDate($this->dayString)) {
                $this->errorMessage = 'Invalid date format. Use YYYY-MM-DD.';
            } else {
                $this->report = $this->controller->generateDailyReport($this->dayString);
            }
        }

        $dayString = $this->dayString;
        $report = $this->report;
        $errorMessage = $this->errorMessage;

        $activePage = 'daily_report';
        $pageTitle = $this->report ? 'Daily Report' : 'Generate Daily Report';

        $contentView = $this->report
            ? __DIR__ . '/views/daily_report_output.view.php'
            : __DIR__ . '/views/daily_report_input.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }

    private function isValidDate(string $value): bool
    {
        $d = DateTime::createFromFormat('Y-m-d', $value);
        return $d && $d->format('Y-m-d') === $value;
    }
}
