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
        if ($id <= 0) {
            return null;
        }

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
        if (
            $id <= 0 ||
            $campaignTitle === '' ||
            $category === '' ||
            $goalAmount === '' ||
            $endDate === '' ||
            $description === ''
        ) {
            return false;
        }

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

        if (!is_numeric($goalAmount) || $goalAmount <= 0) {
        return false;
}

        if (!preg_match('/^[89][0-9]{7}$/', $phone)) {
        return false;
}
    }
}