<?php
require_once __DIR__ . '/../control/deleteFRACategoryController.php';
require_once __DIR__ . '/../control/viewFRACategoryController.php';

class deleteFRACategoryPage {

    private string $message = '';
    private string $messageType = '';

    public function display(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $this->requestDelete((int)$_POST['delete_id']);
        }

        $viewController = new viewFRACategoryController();
        $categories     = $viewController->viewFRACategory();

        $message     = $this->message;
        $messageType = $this->messageType;

        $pageTitle   = 'Delete FRA Category';
        $activePage  = 'delete_cat';
        $contentView = __DIR__ . '/views/delete_fra_category.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }

    public function requestDelete(int $fracategoryId): void {
        $controller = new deleteFRACategoryController();
        $success    = $controller->deleteFRACategory($fracategoryId);
        $this->showResult($success);
    }

    public function showConfirmation(): void {
        // Confirmation modal is rendered inline by the view and triggered via JS.
    }

    public function showResult(bool $success): void {
        if ($success) {
            $this->message     = 'Category deleted successfully.';
            $this->messageType = 'success';
        } else {
            $this->message     = 'Failed to delete category.';
            $this->messageType = 'error';
        }
    }
}

$page = new deleteFRACategoryPage();
$page->display();
