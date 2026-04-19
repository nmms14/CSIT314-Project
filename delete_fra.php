<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'fund_raiser') {
    header('Location: index.php');
    exit;
}

$page = 'delete_fra';

include __DIR__ . '/boundary/deleteFundraisingActivityPage.php';