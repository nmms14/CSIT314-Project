<?php

require_once __DIR__ . '/../entity/dashboardDNEntity.php';

class dashboardDNController
{
    private dashboardDNEntity $dashboardEntity;

    public function __construct()
    {
        $this->dashboardEntity = new dashboardDNEntity();
    }

    public function getDashboardData(string $username): array
    {
        $stats = $this->dashboardEntity->getDonationStats($username);

        return [

            'totalDonations' =>
                $stats['total_donations'] ?? 0,

            'totalAmount' =>
                $stats['total_donated'] ?? 0,

            'savedFraCount' =>
                $this->dashboardEntity->getSavedCount($username),

            'recentDonations' =>
                $this->dashboardEntity->getRecentDonations($username),

            'savedCampaigns' =>
                $this->dashboardEntity->getSavedCampaigns($username),

            'trendingCampaigns' =>
                $this->dashboardEntity->getTrendingCampaigns()
        ];
    }
}