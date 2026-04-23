<?php

require_once __DIR__ . '/../control/searchFRAController.php';

$controller = new SearchFRAController();

$searchKeyword = trim($_GET['keyword'] ?? '');

$results = [];

if ($searchKeyword !== '') {
    $results = $controller->processSearch($searchKeyword);
}

$page = 'search_fra';
$pageTitle = 'FRA Search';

$contentView = __DIR__ . '/views/search_fra.view.php';

include __DIR__ . '/views/layout_fr.view.php';