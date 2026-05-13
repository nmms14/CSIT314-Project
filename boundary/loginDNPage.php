<?php

class loginDNPage {
    public function displayLoginForm(?string $error = null, ?string $message = null): void {
        include __DIR__ . '/views/login.view.php';
    }

    public function login(string $username, string $password): ?string {
        $username = trim($username);
        if ($username === '' || $password === '') {
            return null;
        }

        $controller = new loginDNController();
        if ($controller->login($username, $password)) {
            return 'dashboard_dn.php';
        }
        return null;
    }
}
