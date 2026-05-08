<?php

require_once __DIR__ . '/../entity/Donation.php';

class viewDonationHistoryController
{
	private Donation $donation;

    public function __construct()
    {
        $this->donation = new Donation();
    }
	
	public function getAllDonationHistory(): array
	{
		return $this->donation
					->getAllDonationHistory();
	}
}