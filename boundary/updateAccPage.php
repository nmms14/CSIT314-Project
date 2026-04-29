<?php
require_once __DIR__ . '/../control/updateAccController.php';

	class updateAccPage
	{
		public function display(): void
		{
			$message = '';
			$messageType = '';
			
			$controller = new updateAccController();
			$currUsername = $_POST['currUsername'] ?? $_GET['username'] ?? null;
			
			if (!$currUsername) {
				die("Username not found.");
			}
			
			$user = $controller->getAccDetail($currUsername);

			// HANDLE FORM
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				// Get values
				$name     = trim($_POST['name'] ?? '');
				$username = trim($_POST['username'] ?? '');
				$email    = trim($_POST['email'] ?? '');
				$phone    = trim($_POST['phone'] ?? '');
				$password = $_POST['password'] ?? '';
				$profile  = $_POST['profile'] ?? '';

				// Build data
				$data = [];

				if ($name !== '')     $data['name'] = $name;
				if ($username !== '') $data['username'] = $username;
				if ($email !== '')    $data['email'] = $email;
				if ($phone !== '')    $data['phone'] = $phone;
				if ($password !== '') $data['password'] = $password;
				if ($profile !== '')  $data['profile'] = $profile;

				if (empty($data)) {
					$message = 'Please update at least one field.';
					$messageType = 'error';

				} elseif (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$message = 'Invalid email format.';
					$messageType = 'error';

				} elseif (isset($data['phone']) && !preg_match('/^[0-9]{8}$/', $data['phone'])) {
					$message = 'Phone number should be 8 digits.';
					$messageType = 'error';

				} elseif (isset($data['password']) && strlen($data['password']) < 6) {
					$message = 'Password should be at least 6 characters.';
					$messageType = 'error';

				} else {
					// Call controller with data
					$result = $controller->updateAcc($currUsername, $data);

					$message     = $result['message'] ?? '';
					$messageType = $result['type'] ?? 'error';

					if ($messageType === 'success') {
						$newUsername = $data['username'] ?? $currUsername;

						header("Location: view_acc_detail.php?username=" . urlencode($newUsername) . "&type=success&msg=" . urlencode($message));
						exit;
					}
				}
			}

			$profiles = $controller->loadProfiles();
			
			if (!$user) {
				die("User not found.");
			}
			
			$pageTitle   = 'Dashboard';
			$activePage  = 'view_accounts';
			$contentView = __DIR__ . '/views/update_account.view.php';

			include __DIR__ . '/views/layout_ua.view.php';
		}
	}
?>