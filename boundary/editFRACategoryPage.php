<?php
require_once __DIR__ . '/../control/editFRACategoryController.php';
require_once __DIR__ . '/../control/viewFRACategoryController.php';

class editFRACategoryPage {

    public function display(): void {

        $editController = new editFRACategoryController();
        $viewController = new viewFRACategoryController();

        $message = '';
        $messageType = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $newName = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $oldName = $_POST['old_name'] ?? '';

            if ($newName === '' && $description === '') {
				$message = "Please update at least one field.";
				$messageType = "error";
			} else {

				$result = $editController->editFRACategory($newName, $description, $oldName);

				if ($result) {
					$message = "Category updated successfully.";
					$messageType = "success";
				} else {
					$message = "Failed to update category.";
					$messageType = "error";
				}
			}
        }

        // load categories for display
        $categories = $viewController->viewFRACategory();

        // page setup
        $pageTitle = 'Edit FRA Category';
        $activePage = 'edit_cat';

        $contentView = __DIR__ . '/views/edit_fra_category.view.php';

        include __DIR__ . '/views/layout_pm.view.php';
    }
}

// run page
$page = new editFRACategoryPage();
$page->display();
?>