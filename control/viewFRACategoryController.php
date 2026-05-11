<?php
require_once __DIR__ . '/../entity/FRACategory.php';

class viewFRACategoryController {
	
	public FRACategory $category;
	
	 public function __construct()
    {
        $this->category = new FRACategory();
    }
	
    public function viewFRACategory(): array {
        return $this->category->viewFRACategory();
    }
}
?>