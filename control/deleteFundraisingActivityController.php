<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class DeleteFundraisingActivityController
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

    public function deleteFRA(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        return $this->fundraisingActivity->deleteFRA($id);
    }
}