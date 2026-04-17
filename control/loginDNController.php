<?php

class loginDNController {
    public function login(string $username, string $password): bool {
        $username = trim($username);
        if ($username === '' || $password === '') {
            return false;
        }

        $db = DBConnection::getInstance();
        $dn = new Donee($db);

        if (!$dn->login($username, $password)) {
            return false;
        }

        $_SESSION['user_id'] = $dn->id;
        $_SESSION['username'] = $dn->username;
        $_SESSION['role'] = 'donee';
        return true;
    }
}
