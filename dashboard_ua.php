<?php

session_start();

if (($_SESSION['profile'] ?? null) !== 'user_admin') {
    header('Location: index.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? '');

include __DIR__ . '/boundary/views/dashboard_ua.view.php';
