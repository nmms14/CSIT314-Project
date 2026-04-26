<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';
require_once __DIR__ . '/../config/DBConnection.php';

class createFRAController
{
    public function create(array $data, array $files): array
    {
        $campaignTitle = trim($data['campaign_title'] ?? '');
        $category = trim($data['category'] ?? '');
        $description = trim($data['description'] ?? '');
        $endDate = trim($data['end_date'] ?? '');
        $goalAmount = trim($data['goal_amount'] ?? '');
        $doneeName = trim($data['donee_name'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $fundraiserName = trim($data['fundraiser_name'] ?? '');

        if (
            $campaignTitle === '' || $category === '' || $description === '' ||
            $endDate === '' || $goalAmount === '' || $doneeName === '' ||
            $phone === '' || $fundraiserName === ''
        ) {
            return [
                'message' => 'All fields are required.',
                'type' => 'error'
            ];
        }

        $fra = new FundraisingActivity();

        $success = $fra->createFRA(
            $campaignTitle,
            $category,
            $description,
            $endDate,
            $goalAmount,
            $doneeName,
            $phone,
            $fundraiserName
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