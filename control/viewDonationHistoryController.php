<?php

require_once __DIR__ . '/../entity/Donation.php';

class viewDonationHistoryController
{
	private Donation $donation;

    public function __construct()
    {
        $this->donation = new Donation();
    }
	
	public function getAllDonationHistory(string $username): array
	{
		return $this->donation
					->getAllDonationHistory($username);
	}
}