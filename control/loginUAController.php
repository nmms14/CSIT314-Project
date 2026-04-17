<?php

class loginUAController {
    public function login(string $username, string $password): bool {
        $username = trim($username);
        if ($username === '' || $password === '') {
            return false;
        }

        $db = DBConnection::getInstance();
        $ua = new UserAdmin($db);

        if (!$ua->login($username, $password)) {
            return false;
        }

        $_SESSION['user_id'] = $ua->id;
        $_SESSION['username'] = $ua->username;
        $_SESSION['role'] = 'user_admin';
        return true;
    }
}
