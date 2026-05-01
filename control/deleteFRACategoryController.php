<?php
require_once __DIR__ . '/../entity/FRACategory.php';

class deleteFRACategoryController {

    public function deleteFRACategory(int $fracategoryid): bool {
        if ($fracategoryid <= 0) return false;

        $cat = new FRACategory();
        return $cat->deleteFRACategory($fracategoryid);
    }
}
