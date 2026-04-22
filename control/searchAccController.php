<?php
require_once __DIR__ . '/../entity/UserAccount.php';
require_once __DIR__ . '/../config/DBConnection.php';

class searchAccController {
    public function searchAcc(string $keywords): array {
        $db = DBConnection::getInstance();
        $ua = new UserAccount($db);
        return $ua->searchAcc($keywords);
    }
}
?>