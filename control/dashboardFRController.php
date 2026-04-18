<?php
require_once __DIR__ . '/../config/DBConnection.php';
require_once __DIR__ . '/../entity/FundRaiser.php';

$page = $_GET['page'] ?? '';
$message = '';
$messageType = '';

$db = DBConnection::getInstance();
$fundRaiser = new FundRaiser($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'create_fra') {
    $fraName = trim($_POST['campaign_title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $doneeName = trim($_POST['donee_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $goalAmount = trim($_POST['target_amount'] ?? '');
    $endDate = trim($_POST['end_date'] ?? '');

    if (
        $fraName === '' ||
        $category === '' ||
        $description === '' ||
        $doneeName === '' ||
        $phone === '' ||
        $goalAmount === '' ||
        $endDate === ''
    ) {
        $message = 'Please fill in all fields.';
        $messageType = 'error';
    } elseif (!preg_match('/^[89][0-9]{7}$/', $phone)) {
        $message = 'Phone number must be 8 digits and start with 8 or 9.';
        $messageType = 'error';
    } elseif (!ctype_digit($goalAmount) || $goalAmount <= 0) {
        $message = 'Target amount must be a valid number greater than 0.';
        $messageType = 'error';
    } else {
        $created = $fundRaiser->createFRA(
            $fraName,
            $category,
            $description,
            $endDate,
            $goalAmount,
            $doneeName,
            $phone
        );

        if ($created) {
            $message = 'FRA created successfully.';
            $messageType = 'success';
        } else {
            $message = 'Failed to create FRA.';
            $messageType = 'error';
        }
    }
}

$recordsPerPage = 3;
$currentPage = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
$offset = ($currentPage - 1) * $recordsPerPage;

$totalRecords = $fundRaiser->countAllFRA();
$totalPages = (int) ceil($totalRecords / $recordsPerPage);
$result = $fundRaiser->getFRAByPage($recordsPerPage, $offset);

include __DIR__ . '/../boundary/views/dashboard_fr.view.php';