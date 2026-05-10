<?php
require_once __DIR__ . '/../entity/UserAccount.php';

class searchAccController {
    public function searchAcc(string $keywords): array {
        $ua = new UserAccount();
        return $ua->searchAcc($keywords);
    }
}
?>