<?php
require_once __DIR__ . '/../control/createFRAController.php';

$controller = new CreateFRAController();
$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->createFRA($_POST);

    $message = $result['message'];
    $messageType = $result['status'];
}

require_once __DIR__ . '/views/create_fra.view.php';
?>