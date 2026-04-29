<?php
require_once __DIR__ . '/../control/createAccController.php';

class createAccPage
{
    public function handle(): void
    {
        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = trim($_POST['name'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $phone    = trim($_POST['phone'] ?? '');
            $password = $_POST['password'] ?? '';
            $profile  = $_POST['profile'] ?? '';
			
            if ($name === '' || $username === '' || $email === '' || $password === '' || $profile === '') {
                $message = 'Please fill in all the required fields.';
                $messageType = 'error';

            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = 'Invalid email format.';
                $messageType = 'error';

            } elseif ($phone !== '' && !preg_match('/^[0-9]{8}$/', $phone)) {
                $message = 'Phone number should be 8 digits.';
                $messageType = 'error';

            } elseif (strlen($password) < 6) {
                $message = 'Password should be at least 6 characters.';
                $messageType = 'error';
			} else {
				$controller = new createAccController();
				$result = $controller->createAcc($name, $username, $email, $phone, $password, $profile);
			
				$message     = $result['message'] ?? '';
				$messageType = $result['type'] ?? 'error';
			}
        }

		$pageTitle   = 'Dashboard';
		$activePage  = 'create_acc';
		$contentView = __DIR__ . '/views/create_account.view.php';

		include __DIR__ . '/views/layout_ua.view.php';
    }
}