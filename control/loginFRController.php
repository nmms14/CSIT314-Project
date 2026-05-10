<?php

class loginFRController {
    public function login(string $username, string $password): bool {
        $username = trim($username);
        if ($username === '' || $password === '') {
            return false;
        }

        $fr = new FundRaiser();

        if (!$fr->login($username, $password)) {
            return false;
        }

        $_SESSION['user_id'] = $fr->id;
        $_SESSION['username'] = $fr->username;
        $_SESSION['profile'] = 'fund_raiser';
        return true;
    }
}
