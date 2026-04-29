<?php
require_once __DIR__ . '/../entity/FRACategory.php';

class createFRACategoryController
{
    public function __construct() {}

    public function createFRACategory(string $name, string $description): array {
        $entity = new FRACategory();
        return $entity->createFRACategory($name, $description);
    }
}