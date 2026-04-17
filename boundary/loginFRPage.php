<?php

class loginFRPage {
    public function displayLoginForm(?string $error = null, ?string $message = null): void {
        include __DIR__ . '/views/login.view.php';
    }

    public function login(string $username, string $password): ?string {
        $controller = new loginFRController();
        if ($controller->login($username, $password)) {
            return 'dashboard_fr.php';
        }
        return null;
    }
}
