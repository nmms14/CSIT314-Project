<?php

class loginPMPage {
    public function login(string $username, string $password): ?string {
        $controller = new loginPMController();
        if ($controller->login($username, $password)) {
            return 'dashboard_pm.php';
        }
        return null;
    }
}
