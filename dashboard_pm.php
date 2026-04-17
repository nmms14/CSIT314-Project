<?php

session_start();

if (($_SESSION['profile'] ?? null) !== 'platform_manager') {
    header('Location: index.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? '');

include __DIR__ . '/boundary/views/dashboard_pm.view.php';
