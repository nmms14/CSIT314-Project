<?php

class loginUAPage {
    public function displayLoginForm(?string $error = null, ?string $message = null): void {
        include __DIR__ . '/views/login.view.php';
    }

    public function login(string $username, string $password): ?string {
        $controller = new loginUAController();
        if ($controller->login($username, $password)) {
            return 'dashboard_ua.php';
        }
        return null;
    }
}
