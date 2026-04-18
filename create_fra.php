<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'fund_raiser') {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/boundary/createFRAPage.php';

$page = new createFRAPage();
$page->handle();