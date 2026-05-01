<?php
require_once __DIR__ . '/../entity/FRACategory.php';

class searchFRACategoryController {

    public function searchfracategoryid(string $keywords): array {
        $cat = new FRACategory();
        return $cat->searchfracategoryid($keywords);
    }
}
