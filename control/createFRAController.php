<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

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
                'message' => 'FRA created successfully.',
                'type' => 'success'
            ];
        }

        return [
            'message' => 'Failed to create FRA.',
            'type' => 'error'
        ];
    }
}