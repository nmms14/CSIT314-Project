<?php

class loginUAController {
    public function login(string $username, string $password): bool {
        $ua = new UserAdmin();

        if (!$ua->login($username, $password)) {
            return false;
        }

        $_SESSION['user_id'] = $ua->id;
        $_SESSION['username'] = $ua->username;
        $_SESSION['profile'] = 'user_admin';
        return true;
    }
}
