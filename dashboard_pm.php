<?php

session_start();

if (($_SESSION['profile'] ?? null) !== 'platform_manager') {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/boundary/dashboardPMPage.php';

$page = new dashboardPMPage();
$page -> display();