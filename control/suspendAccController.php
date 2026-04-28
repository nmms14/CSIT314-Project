<?php
	require_once __DIR__ . '/../config/DBConnection.php';
	require_once __DIR__ . '/../entity/UserAccount.php';

	class suspendAccController {

		public function suspendAcc(string $username): array {

			$db = DBConnection::getInstance();
			$ua = new UserAccount($db);

			$user = $ua->getAccDetail($username);

			if (!$user) {
				return ['type' => 'error', 'message' => 'Account not found.'];
			}

			if ($user->status === 'Suspended') {
				return ['type' => 'error', 'message' => 'Account already suspended.'];
			}

			$success = $ua->suspendAcc($username);

			if ($success !== null) {
				return ['type' => 'success', 'message' => 'Account suspended successfully.'];
			}

			return ['type' => 'error', 'message' => 'Unable to suspend user.'];
		}
	}

?>