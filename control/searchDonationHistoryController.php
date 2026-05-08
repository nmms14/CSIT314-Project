<?php

require_once __DIR__ . '/../entity/Donation.php';

class searchDonationHistoryController
{
	private Donation $donation;

    public function __construct()
    {
        $this->donation = new Donation();
    }

    public function searchDonationHistory(string $keyword): array
    {
        return $this->donation->searchDonationHistory($keyword);
    }
}