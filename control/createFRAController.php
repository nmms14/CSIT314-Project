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
        $goalAmount = trim($data['target_amount'] ?? '');
        $doneeName = trim($data['donee_name'] ?? '');
        $phone = trim($data['phone'] ?? '');

        if (
            $campaignTitle === '' || $category === '' || $description === '' ||
            $endDate === '' || $goalAmount === '' || $doneeName === '' || $phone === ''
        ) {
            return [
                'message' => 'All fields are required.',
                'type' => 'error'
            ];
        }

        $db = DBConnection::getInstance();
        $fra = new FundraisingActivity($db);

        $success = $fra->createFRA(
            $campaignTitle,
            $category,
            $description,
            $endDate,
            $goalAmount,
            $doneeName,
            $phone
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