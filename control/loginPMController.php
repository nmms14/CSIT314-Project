<?php

class loginPMController {
    public function login(string $username, string $password): bool {
        $username = trim($username);
        if ($username === '' || $password === '') {
            return false;
        }

        $db = DBConnection::getInstance();
        $pm = new PlatformManager($db);

        if (!$pm->login($username, $password)) {
            return false;
        }

        $_SESSION['user_id'] = $pm->id;
        $_SESSION['username'] = $pm->username;
        $_SESSION['profile'] = 'platform_manager';
        return true;
    }
}
