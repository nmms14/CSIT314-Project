<?php
require_once __DIR__ . '/../control/createFRACategoryController.php';

class createFRACategoryPage
{
    public function display(): void
    {
        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if ($name === '') {
                $message     = 'Category name is required.';
                $messageType = 'error';
            } else {
                $controller = new createFRACategoryController();
                $result = $controller->createFRACategory($name, $description);

                $message     = $result['message'] ?? '';
                $messageType = $result['type'] ?? 'error';

                if ($messageType === 'success') {
                    header('Location: view_cat.php?created=1');
                    exit;
                }
            }
        }

        $pageTitle   = 'Dashboard';
        $activePage  = 'create_cat';
        $contentView = __DIR__ . '/views/create_fra_category.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }
}