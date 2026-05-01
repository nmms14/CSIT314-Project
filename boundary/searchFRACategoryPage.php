<?php
require_once __DIR__ . '/../control/searchFRACategoryController.php';
require_once __DIR__ . '/../control/viewFRACategoryController.php';

class searchFRACategoryPage {

    public function display(): void {
        $keywords = trim($_GET['keywords'] ?? '');

        if ($keywords !== '') {
            $controller = new searchFRACategoryController();
            $categories = $controller->searchfracategoryid($keywords);
        } else {
            $viewController = new viewFRACategoryController();
            $categories = $viewController->viewFRACategory();
        }

        $pageTitle   = 'Search FRA Category';
        $activePage  = 'search_cat';
        $contentView = __DIR__ . '/views/search_fra_category.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }
}

$page = new searchFRACategoryPage();
$page->display();
