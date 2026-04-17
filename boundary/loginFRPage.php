<?php

class loginFRPage {
    public function login(string $username, string $password): ?string {
        $controller = new loginFRController();
        if ($controller->login($username, $password)) {
            return 'dashboard_fr.php';
        }
        return null;
    }
}
