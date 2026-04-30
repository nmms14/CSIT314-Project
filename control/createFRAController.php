<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';
require_once __DIR__ . '/../entity/FRACategory.php';

class createFRAController
{
    public function create(array $data): array
    {
        $fra = new FundraisingActivity();

        $success = $fra->createFRA(
            $data['campaign_title'],
            $data['category'],
            $data['description'],
            $data['end_date'],
            $data['goal_amount'],
            $data['donee_name'],
            $data['phone'],
            $data['fundraiser_name']
        );

        if ($success) {
            return [
                'popupMessage' => 'FRA created successfully.',
                'popupType' => 'success'
            ];
        }

        return [
            'popupMessage' => 'Failed to create FRA.',
            'popupType' => 'error'
        ];
    }

    public function getCategories(): array
    {
        $entity = new FRACategory();
        return $entity->getAllCategories();
    }
}