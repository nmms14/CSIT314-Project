<?php

require_once __DIR__ . '/../control/saveFRAController.php';

class saveFRAPage
{
    private saveFRAController $controller;

    public function __construct()
    {
        $this->controller = new saveFRAController();
    }

    public function saveFRA(): void
    {
        $fraId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $username = $_SESSION['username'] ?? '';
		
		if ($username === '' || $fraId <= 0) {
            return;
        }
		
        $success = $this->controller->saveFavouriteFRA($username, $fraId);

        if ($success) {
    header('Location: search_dn_fra.php?success=saved');
} else {
    header('Location: search_dn_fra.php?error=exists');
}

exit;

    }
}

$pageObject = new saveFRAPage();
$pageObject->saveFRA();