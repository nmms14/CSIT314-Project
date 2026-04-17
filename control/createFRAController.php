<?php
require_once __DIR__ . '/../entity/FundRaiser.php';

class CreateFRAController
{
    public function createFRA($data)
    {
        $fraName = trim($data['fra_name'] ?? '');
        $description = trim($data['description'] ?? '');
        $startDate = trim($data['start_date'] ?? '');
        $endDate = trim($data['end_date'] ?? '');
        $goalAmount = trim($data['goal_amount'] ?? '');

        if (
            empty($fraName) ||
            empty($description) ||
            empty($startDate) ||
            empty($endDate) ||
            empty($goalAmount)
        ) {
            return [
                'status' => 'error',
                'message' => 'Please fill in all fields.'
            ];
        }

        if (!is_numeric($goalAmount) || $goalAmount <= 0) {
            return [
                'status' => 'error',
                'message' => 'Goal amount must be a valid number greater than 0.'
            ];
        }

        if ($endDate < $startDate) {
            return [
                'status' => 'error',
                'message' => 'End date cannot be earlier than start date.'
            ];
        }

        $fundRaiser = new FundRaisingActivity();
        $isCreated = $fundRaiser->createFundraisingActivity(
            $fraName,
            $description,
            $startDate,
            $endDate,
            $goalAmount
        );

        if ($isCreated) {
            return [
                'status' => 'success',
                'message' => 'Fundraising activity created successfully.'
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Failed to create fundraising activity.'
        ];
    }
}
?>