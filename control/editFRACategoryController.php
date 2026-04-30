<?php
require_once __DIR__ . '/../entity/FRACategory.php';

class editFRACategoryController {

    public function editFRACategory(string $newName, string $description, string $oldName): bool {
		$cat = new FRACategory();
		return $cat->editFRACategory($newName, $description, $oldName);
	}
}
?>