<?php

class loginDNPage {
    public function displayLoginForm(?string $error = null, ?string $message = null): void {
        include __DIR__ . '/views/login.view.php';
    }

    public function login(string $username, string $password): ?string {
        $controller = new loginDNController();
        if ($controller->login($username, $password)) {
            return 'dashboard_dn.php';
        }
        return null;
    }
}
