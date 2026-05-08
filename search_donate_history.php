<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

$activePage = 'donation_history';
$pageTitle = 'Donation History';

include __DIR__ . '/boundary/donationHistoryPage.php';