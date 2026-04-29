<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

$activePage = 'dashboard';
$pageTitle = 'Dashboard';
$contentView = __DIR__ . '/boundary/views/dashboard_dn.view.php';

include __DIR__ . '/boundary/views/layout_dn.view.php';