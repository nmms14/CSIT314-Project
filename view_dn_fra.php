<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

$activePage = 'browse_fra';
$pageTitle = 'View FRA Details';

include __DIR__ . '/boundary/viewDNFRAPage.php';