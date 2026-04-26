<?php

require_once __DIR__ . '/../control/updateFRAController.php';

class updateFRAPage
{
    private UpdateFRAController $controller;
    private string $popupMessage = '';
    private string $popupType = '';
    private string $mode = 'list';
    private ?array $fra = null;
    private array $fraList = [];

    public function __construct()
    {
        $this->controller = new UpdateFRAController();
    }

    public function handleUpdateRequest(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['cancel_update'])) {
                header('Location: update_fra.php');
                exit;
            }

            $id = (int)($_POST['id'] ?? 0);
            $campaignTitle = trim($_POST['campaign_title'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $goalAmount = trim($_POST['goal_amount'] ?? '');
            $endDate = trim($_POST['end_date'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $doneeName = trim($_POST['donee_name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            $updated = $this->controller->updateFRA(
                $id,
                $campaignTitle,
                $category,
                $goalAmount,
                $endDate,
                $description,
                $doneeName,
                $phone
            );

            if ($updated) {
                $this->displayMessage('FRA updated successfully.', 'success');
                $this->mode = 'list';
                $this->fraList = $this->controller->getAllFRA();
            } else {
                $this->displayMessage('Failed to update FRA.', 'error');
                $this->mode = 'form';

                $this->fra = [
                    'id' => $id,
                    'campaign_title' => $campaignTitle,
                    'category' => $category,
                    'goal_amount' => $goalAmount,
                    'end_date' => $endDate,
                    'description' => $description,
                    'donee_name' => $doneeName,
                    'phone' => $phone
                ];
            }

        } else {

            if ($id > 0) {
                $this->displayUpdateForm($id);
            } else {
                $this->displayFRAList();
            }
        }
    }

    public function displayFRAList(): void
    {
        $this->fraList = $this->controller->getAllFRA();
        $this->mode = 'list';
    }

    public function displayUpdateForm(int $id): void
    {
        $this->fra = $this->controller->getFRAById($id);
        $this->mode = 'form';
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
    $mode = $this->mode;
    $fra = $this->fra;
    $fraList = $this->fraList;

    $page = 'update_fra';
    $pageTitle = 'Update FRA';

    $contentView = __DIR__ . '/views/update_fra.view.php';

    include __DIR__ . '/views/layout_fr.view.php';
}
}

$page = new updateFRAPage();
$page->handleUpdateRequest();
$page->render();