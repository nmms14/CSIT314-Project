<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'fund_raiser') {
    header('Location: index.php');
    exit;
}

$page = 'search_fra';
$pageTitle = 'FRA Search';

include __DIR__ . '/boundary/searchFRAPage.php';