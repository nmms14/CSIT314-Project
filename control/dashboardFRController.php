<?php

require_once __DIR__ . '/../entity/dashboardFREntity.php';

class dashboardFRController
{
    private dashboardFREntity $dashboardEntity;

    public function __construct()
    {
        $this->dashboardEntity = new dashboardFREntity();
    }

    public function getDashboardData(string $username): array
    {
        $stats = $this->dashboardEntity->getDashboardStats($username);

        $totalActiveFra = $stats['total_active_fra'] ?? 0;
        $totalGoal = $stats['total_goal'] ?? 0;
        $totalRaised = $stats['total_raised'] ?? 0;

        $averageProgress = 0;

        if ($totalGoal > 0) {
            $averageProgress = min(
                100,
                round(($totalRaised / $totalGoal) * 100)
            );
        }

        return [
            'totalActiveFra' => $totalActiveFra,
            'totalGoal' => $totalGoal,
            'totalRaised' => $totalRaised,
            'averageProgress' => $averageProgress,
            'activeFras' => $this->dashboardEntity->getActiveFRAProgress($username),
            'recentActivities' => $this->dashboardEntity->getRecentActivities($username)
        ];
    }
}