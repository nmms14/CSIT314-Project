<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'user_admin') {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/boundary/updateAccPage.php';

$page = new updateAccPage();
$page->handle();
?>