<?php

require_once __DIR__ . '/../entity/Donation.php';

class viewDonatedFRAProgressController
{
	private Donation $donation;

    public function __construct()
    {
        $this->donation = new Donation();
    }

    public function viewDonatedFRA(string $username): array
    {
        return $this->donation->viewDonatedFRA($username);
    }
}