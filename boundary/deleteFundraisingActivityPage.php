<?php

require_once __DIR__ . '/../control/deleteFundraisingActivityController.php';

class DeleteFundraisingActivityPage
{
    private DeleteFundraisingActivityController $controller;
    private string $popupMessage = '';
    private string $popupType = '';
    private array $fraList = [];

    public function __construct()
    {
        $this->controller = new DeleteFundraisingActivityController();
    }

    public function handleDeleteRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['delete_cancelled']) && $_POST['delete_cancelled'] === '1') {

                $this->displayMessage("Deletion cancelled.", "cancel");

            } elseif (isset($_POST['delete_id']) && $_POST['delete_id'] !== '') {

                $id = (int) $_POST['delete_id'];

                if ($this->controller->deleteFRA($id)) {
                    $this->displayMessage("FRA deleted successfully.", "success");
                } else {
                    $this->displayMessage("Failed to delete FRA.", "error");
                }
            }
        }

        $this->displayFRAList();
    }

    public function displayFRAList(): void
    {
        $this->fraList = $this->controller->getAllFRA();
    }

    public function displayMessage(string $message, string $type): void
    {
        $this->popupMessage = $message;
        $this->popupType = $type;
    }

public function render(): void
{
    $popupMessage = $this->popupMessage;
    $popupType = $this->popupType;
    $fraList = $this->fraList;

    $page = 'delete_fra';
    $pageTitle = 'Delete FRA';

    $contentView = __DIR__ . '/views/delete_fra.view.php';

    include __DIR__ . '/views/layout_fr.view.php';
}
}

$page = new DeleteFundraisingActivityPage();
$page->handleDeleteRequest();
$page->render();