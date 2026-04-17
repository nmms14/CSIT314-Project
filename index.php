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
    'user_admin'       => 'dashboard_ua.php',
    'fund_raiser'      => 'dashboard_fr.php',
    'donee'            => 'dashboard_dn.php',
];

if (isset($_SESSION['role'], $dashboards[$_SESSION['role']])) {
    header('Location: ' . $dashboards[$_SESSION['role']]);
    exit;
}

$loginPages = [
    'loginPMPage',
    'loginUAPage',
    'loginFRPage',
    'loginDNPage',
];

$error = null;
$message = isset($_GET['logged_out']) ? 'Successfully logged out.' : null;

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

(new loginPMPage())->displayLoginForm($error, $message);
