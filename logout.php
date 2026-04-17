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

$redirect = (new LogoutPage())->requestLogout();
header('Location: ' . $redirect);
exit;
