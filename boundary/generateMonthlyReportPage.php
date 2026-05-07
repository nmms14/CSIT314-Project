<?php

require_once __DIR__ . '/../control/generateMonthlyReportController.php';

class generateMonthlyReportPage
{
    private generateMonthlyReportController $controller;
    private string $monthString = '';
    private ?array $report = null;
    private string $errorMessage = '';

    public function __construct()
    {
        $this->controller = new generateMonthlyReportController();
    }

    public function display(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->monthString = trim($_POST['month'] ?? '');

            if ($this->monthString === '') {
                $this->errorMessage = 'Please select a month.';
            } elseif (!$this->isValidMonth($this->monthString)) {
                $this->errorMessage = 'Invalid month format. Use YYYY-MM.';
            } else {
                $this->report = $this->controller->generateMonthlyReport($this->monthString);
            }
        }

        $monthString = $this->monthString;
        $report = $this->report;
        $errorMessage = $this->errorMessage;

        $activePage = 'monthly_report';
        $pageTitle = $this->report ? 'Monthly Report' : 'Generate Monthly Report';

        $contentView = $this->report
            ? __DIR__ . '/views/monthly_report_output.view.php'
            : __DIR__ . '/views/monthly_report_input.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }

    private function isValidMonth(string $value): bool
    {
        $d = DateTime::createFromFormat('Y-m', $value);
        return $d && $d->format('Y-m') === $value;
    }
}
