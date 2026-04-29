<?php
require_once __DIR__ . '/../config/DBConnection.php';

class FavouriteFundraisingActivity {

    private mysqli $db;

    public function __construct() {
        $this->db = DBConnection::getInstance();
    }
	
    public function viewFavouriteFRA(string $username): array {
        $stmt = $this->db->prepare(
            "SELECT fa.*
             FROM fundraising_activity fa
             JOIN favourite_fundraising_activity f
             ON fa.id = f.activity_id
             WHERE f.username = ?"
        );
		
		if (!$stmt) return [];

        $stmt->bind_param("s", $username);
        $stmt->execute();
		
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}