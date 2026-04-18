<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserAdmin.php';

	class createAccController {
		 public function create(string $name, string $username, string $email, string $phone, string $password, string $profile): bool {
			 $db = DBConnection::getInstance();
			 $ua = new UserAdmin($db);
			 return $ua->createUser($name, $username, $email, $phone, $password, $profile);
		 }
	}
?>
