<?php

session_start();

if (($_SESSION['profile'] ?? null) !== 'fund_raiser') {
    header('Location: index.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? '');

include __DIR__ . '/boundary/views/dashboard_fr.view.php';
