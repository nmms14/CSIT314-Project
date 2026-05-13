<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class UpdateFRAController
{
    private FundraisingActivity $fundraisingActivity;

    public function __construct()
    {
        $this->fundraisingActivity = new FundraisingActivity();
    }

    public function getAllFRA(): array
    {
        return $this->fundraisingActivity->getAllFRA();
    }

    public function getFRAById(int $id): ?array
    {
        return $this->fundraisingActivity->getFRAById($id);
    }

    public function updateFRA(
        int $id,
        string $campaignTitle,
        string $category,
        string $goalAmount,
        string $endDate,
        string $description,
        string $doneeName,
        string $phone
    ): bool {
        return $this->fundraisingActivity->updateFRA(
            $id,
            $campaignTitle,
            $category,
            $goalAmount,
            $endDate,
            $description,
            $doneeName,
            $phone
        );
    }
}