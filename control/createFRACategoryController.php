<?php
require_once __DIR__ . '/../entity/FRACategory.php';

class createFRACategoryController
{
	private FRACategory $entity;
	
    public function __construct() {
		$this->entity = new FRACategory();
	}

    public function createFRACategory(string $name, string $description): array {
        return $this->entity->createFRACategory($name, $description);
    }
}