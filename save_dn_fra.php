<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

include __DIR__ . '/boundary/saveFRAPage.php';