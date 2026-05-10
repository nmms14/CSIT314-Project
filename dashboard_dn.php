<?php

session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/boundary/dashboardDNPage.php';

$page = new dashboardDNPage();
$page->display();