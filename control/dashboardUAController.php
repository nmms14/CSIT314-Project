<?php

require_once __DIR__ . '/../entity/dashboardUAEntity.php';

class dashboardUAController
{
    private dashboardUAEntity $dashboard;

    public function __construct()
    {
        $this->dashboard = new dashboardUAEntity();
    }

    public function getTotalUsers(): int
    {
        return $this->dashboard->getTotalUsers();
    }

    public function getSuspendedAccounts(): int
    {
        return $this->dashboard->getSuspendedAccounts();
    }

    public function getActiveAccounts(): int
    {
        return $this->dashboard->getActiveAccounts();
    }

    public function getTotalProfiles(): int
    {
        return $this->dashboard->getTotalProfiles();
    }

    public function getNewUsers(): int
    {
        return $this->dashboard->getNewUsers();
    }

    public function getRecentAccounts(): array
    {
        return $this->dashboard->getRecentAccounts();
    }
}