<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'fund_raiser') {
    header('Location: index.php');
    exit;
}

$page = 'update_fra';
$pageTitle = 'FRA Update';

include __DIR__ . '/boundary/updateFRAPage.php';