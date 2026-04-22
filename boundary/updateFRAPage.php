<?php

require_once __DIR__ . '/../control/updateFRAController.php';

$controller = new UpdateFRAController();

$popupMessage = '';
$popupType = '';
$mode = 'list';
$fra = null;
$fraList = [];

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel_update'])) {
        header('Location: update_fra.php');
        exit;
    }

    $id = (int)($_POST['id'] ?? 0);
    $campaignTitle = trim($_POST['campaign_title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $goalAmount = trim($_POST['goal_amount'] ?? '');
    $endDate = trim($_POST['end_date'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $doneeName = trim($_POST['donee_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    $updated = $controller->updateFRA(
        $id,
        $campaignTitle,
        $category,
        $goalAmount,
        $endDate,
        $description,
        $doneeName,
        $phone
    );

    if ($updated) {
        $popupMessage = 'FRA updated successfully.';
        $popupType = 'success';
        $mode = 'list';
        $fraList = $controller->getAllFRA();
    } else {
        $popupMessage = 'Failed to update FRA.';
        $popupType = 'error';
        $mode = 'form';
        $fra = [
            'id' => $id,
            'campaign_title' => $campaignTitle,
            'category' => $category,
            'goal_amount' => $goalAmount,
            'end_date' => $endDate,
            'description' => $description,
            'donee_name' => $doneeName,
            'phone' => $phone
        ];
    }
} else {
    if ($id > 0) {
        $fra = $controller->getFRAById($id);
        $mode = 'form';
    } else {
        $fraList = $controller->getAllFRA();
        $mode = 'list';
    }
}

$contentView = __DIR__ . '/views/update_fra.view.php';
include __DIR__ . '/views/layout_fr.view.php';