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

if (isset($_SESSION['profile'], $dashboards[$_SESSION['profile']])) {
    header('Location: ' . $dashboards[$_SESSION['profile']]);
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

$profileDbNames = [
    'platform_manager' => 'Platform Manager',
    'user_admin'       => 'User Admin',
    'fund_raiser'      => 'Fundraiser',
    'donee'            => 'Donee',
];

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    foreach ($loginPages as $pageClass) {
        $redirect = (new $pageClass())->login($username, $password);
        if ($redirect !== null) {
            $profileKey  = $_SESSION['profile'] ?? '';
            $profileName = $profileDbNames[$profileKey] ?? '';

            $stmt = DBConnection::getInstance()->prepare(
                "SELECT status FROM user_profiles WHERE profile_name = ? LIMIT 1"
            );
            $stmt->bind_param('s', $profileName);
            $stmt->execute();
            $stmt->bind_result($status);
            $stmt->fetch();
            $stmt->close();

            if ($status === 'Suspended') {
                unset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['profile']);
                $error = 'This profile has been suspended. Please contact an administrator.';
                break;
            }

            header('Location: ' . $redirect);
            exit;
        }
    }
    if ($error === null) {
        $error = 'Invalid username or password.';
    }
}

(new loginPMPage())->displayLoginForm($error, $message);
