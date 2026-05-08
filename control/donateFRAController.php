<?php

require_once __DIR__ . '/../entity/Donation.php';

class donateFRAController
{
	private Donation $donation;

    public function __construct()
    {
        $this->donation = new Donation();
    }

    public function donateToFRA(int $fraId, string $doneeName, float $amount): bool
    {
        return $this->donation->donateToFRA(
			$fraId,
			$doneeName,
			$amount
		);
    }
}