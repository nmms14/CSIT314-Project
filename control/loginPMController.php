<?php

class loginPMController {
    public function login(string $username, string $password): bool {
        $pm = new PlatformManager();

        if (!$pm->login($username, $password)) {
            return false;
        }

        $_SESSION['user_id'] = $pm->id;
        $_SESSION['username'] = $pm->username;
        $_SESSION['profile'] = 'platform_manager';
        return true;
    }
}
