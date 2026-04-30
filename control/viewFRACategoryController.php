<?php
require_once __DIR__ . '/../entity/FRACategory.php';

class viewFRACategoryController {

    public function viewFRACategory(): array {
        $category = new FRACategory();
        return $category->viewFRACategory();
    }
}
?>