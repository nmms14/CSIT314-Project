<?php
session_start();

if (($_SESSION['profile'] ?? null) !== 'donee') {
    header('Location: index.php');
    exit;
}

$keyword = trim($_GET['keyword'] ?? '');

if ($keyword === '') {
    require_once __DIR__ . '/boundary/viewFavouriteFRAPage.php';

    $page = new ViewFavouritePage();
    $page->viewFRA();
} else {
    require_once __DIR__ . '/boundary/searchFavouriteFRAPage.php';

    $page = new searchFavouriteFRAPage();
    $page->display();
}
