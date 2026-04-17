<?php

class loginFRController {
    public function login(string $username, string $password): bool {
        $username = trim($username);
        if ($username === '' || $password === '') {
            return false;
        }

        $db = DBConnection::getInstance();
        $fr = new FundRaiser($db);

        if (!$fr->login($username, $password)) {
            return false;
        }

        $_SESSION['user_id'] = $fr->id;
        $_SESSION['username'] = $fr->username;
<<<<<<< Updated upstream
        $_SESSION['role'] = 'fundraiser';
=======
        $_SESSION['role'] = 'fund_raiser';
>>>>>>> Stashed changes
        return true;
    }
}
