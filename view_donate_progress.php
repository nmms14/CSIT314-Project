<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

$activePage = 'view_progress';
$pageTitle = 'Donation Progress';

include __DIR__ . '/boundary/viewDonatedFRAProgressPage.php';