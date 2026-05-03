<?php
require_once __DIR__ . '/../control/viewFRACategoryController.php';

class viewFRACategoryPage {

    public function display(): void {
        $message = '';
        $messageType = '';

        if (isset($_GET['created'])) {
            $message = 'Category created successfully!';
            $messageType = 'success';
        }

        $controller = new viewFRACategoryController();

        // get categories (with fra_count)
        $categories = $controller->viewFRACategory();

        // page setup
        $pageTitle = 'FRA Category View';
        $activePage = 'view_cat';

        $contentView = __DIR__ . '/views/view_fra_category.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }
}

// run page
$page = new viewFRACategoryPage();
$page->display();
?>