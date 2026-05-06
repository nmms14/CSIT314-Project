<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class viewDNFRAController
{
    private FundraisingActivity $fundraisingActivity;

    public function __construct()
    {
        $this->fundraisingActivity = new FundraisingActivity();
    }

    public function getFRADetails(int $fraId): ?array
    {
        if ($fraId <= 0) {
            return null;
        }

        $this->fundraisingActivity->increaseFRAView($fraId);

        return $this->fundraisingActivity->getFRAById($fraId);
    }
}