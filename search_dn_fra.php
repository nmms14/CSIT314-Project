<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

$activePage = 'browse_fra';
$pageTitle = 'Browse FRA';

include __DIR__ . '/boundary/doneeSearchFRAPage.php';