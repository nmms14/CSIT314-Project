<?php

require_once __DIR__ . '/../control/deleteFundraisingActivityController.php';

$controller = new DeleteFundraisingActivityController();

$popupMessage = '';
$popupType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete_cancelled']) && $_POST['delete_cancelled'] === '1') {
        $popupMessage = "Deletion cancelled.";
        $popupType = "cancel";
    } elseif (isset($_POST['delete_id']) && $_POST['delete_id'] !== '') {
        $id = (int) $_POST['delete_id'];

        if ($controller->deleteFRA($id)) {
            $popupMessage = "FRA deleted successfully.";
            $popupType = "success";
        } else {
            $popupMessage = "Failed to delete FRA.";
            $popupType = "error";
        }
    }
}

$fraList = $controller->getAllFRA();


$contentView = __DIR__ . '/views/delete_fra.view.php';

include __DIR__ . '/views/layout_fr.view.php';