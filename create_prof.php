<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'user_admin') {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/boundary/createUserProfilePage.php';

$page = new createUserProfilePage();
$page->clickCreateUserProfile();
