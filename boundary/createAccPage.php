<?php
	require_once __DIR__ . '/../control/createAccController.php';
	
	$controller = new createAccController();
	
	$message = "";
	$msgClass = "";
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$name = $_POST['name'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$password = $_POST['password'];
			$profile = $_POST['profile'];
			
		$success = $controller->createAcc($name, $username, $email, $phone, $password, $profile);

		if ($success) {
			$message = "Account created successfully!";
			$msgClass = "success";
		}
		else {
			$message = "Username already exists.";
			$msgClass = "error";
		}
	}
	
	require_once __DIR__ . '/views/create_account.view.php';
?>
