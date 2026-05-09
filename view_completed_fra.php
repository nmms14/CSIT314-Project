<?php

session_start();

if ( ($_SESSION['profile'] ?? '') !== 'fund_raiser') {
    header('Location: index.php');
    exit;
}

$activePage = 'view_completed';

include __DIR__ . '/boundary/viewCompletedFRAPage.php';