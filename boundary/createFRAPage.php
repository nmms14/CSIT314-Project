<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../control/createFRAController.php';

class createFRAPage
{
    public function handle(): void
    {
        $popupMessage = '';
        $popupType = '';

        $controller = new createFRAController();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'campaign_title'  => trim($_POST['campaign_title'] ?? ''),
                'category'        => trim($_POST['category'] ?? ''),
                'description'     => trim($_POST['description'] ?? ''),
                'end_date'        => trim($_POST['end_date'] ?? ''),
                'goal_amount'     => trim($_POST['goal_amount'] ?? ''),
                'donee_name'      => trim($_POST['donee_name'] ?? ''),
                'phone'           => trim($_POST['phone'] ?? ''),
                'fundraiser_name' => $_SESSION['username'] ?? 'Unknown'
            ];

            if (
                $data['campaign_title'] === '' ||
                $data['category'] === '' ||
                $data['description'] === '' ||
                $data['end_date'] === '' ||
                $data['goal_amount'] === '' ||
                $data['donee_name'] === '' ||
                $data['phone'] === '' ||
                $data['fundraiser_name'] === ''
            ) {
                $popupMessage = 'All fields are required.';
                $popupType = 'error';
            } else {
                $response = $controller->create($data);

                $popupMessage = $response['popupMessage'];
                $popupType = $response['popupType'];

                if ($response['popupType'] === 'success') {
                $_POST = [];
                }
            }
        }

        $pageTitle = 'Create FRA';
        $activePage = 'create_fra';
        $contentView = __DIR__ . '/views/create_fra.view.php';

        $categories = $controller->getCategories();

        include __DIR__ . '/views/layout_fr.view.php';
    }
}