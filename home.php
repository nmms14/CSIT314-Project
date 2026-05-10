<?php

session_start();

$dashboards = [
    'platform_manager' => 'dashboard_pm.php',
    'user_admin'       => 'dashboard_ua.php',
    'fund_raiser'      => 'dashboard_fr.php',
    'donee'            => 'dashboard_dn.php',
];

if (isset($_SESSION['profile'], $dashboards[$_SESSION['profile']])) {
    header('Location: ' . $dashboards[$_SESSION['profile']]);
    exit;
}

require_once __DIR__ . '/boundary/homePage.php';

$page = new homePage();
$page->display();
