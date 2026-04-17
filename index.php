<?php

session_start();

spl_autoload_register(function (string $class): void {
    $dirs = ['boundary', 'control', 'entity', 'config'];
    foreach ($dirs as $dir) {
        $path = __DIR__ . '/' . $dir . '/' . $class . '.php';
        if (is_file($path)) {
            require_once $path;
            return;
        }
    }
});

$dashboards = [
    'platform_manager' => 'dashboard_pm.php',
    'fundraiser'       => 'dashboard_fr.php',
    // 'user_admin'    => 'dashboard_ua.php',
    // 'cleaner'       => 'dashboard_cl.php',
    // 'home_owner'    => 'dashboard_ho.php',
];

if (isset($_SESSION['role'], $dashboards[$_SESSION['role']])) {
    header('Location: ' . $dashboards[$_SESSION['role']]);
    exit;
}

$loginPages = [
    'loginPMPage',
    'loginFRPage',
    // 'loginUAPage',
    // 'loginCLPage',
    // 'loginHOPage',
];

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    foreach ($loginPages as $pageClass) {
        $redirect = (new $pageClass())->login($username, $password);
        if ($redirect !== null) {
            header('Location: ' . $redirect);
            exit;
        }
    }
    $error = 'Invalid username or password.';
}

include __DIR__ . '/boundary/views/login.view.php';
