<?php

require_once __DIR__ . '/../control/searchFRAController.php';

class searchFRAPage
{
    private SearchFRAController $controller;
    private string $searchKeyword = '';
    private array $results = [];

    public function __construct()
    {
        $this->controller = new SearchFRAController();
    }

    public function handleSearchRequest(): void
    {
        $this->searchKeyword = trim($_GET['keyword'] ?? '');

        if ($this->searchKeyword !== '') {
            $this->displayMatchingResults();
        }
    }

    public function displayMatchingResults(): void
    {
        $this->results = $this->controller->processSearch($this->searchKeyword);
    }

    public function render(): void
    {
        $searchKeyword = $this->searchKeyword;
        $results = $this->results;

        $page = 'search_fra';
        $pageTitle = 'FRA Search';

        $contentView = __DIR__ . '/views/search_fra.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}

$pageObject = new searchFRAPage();
$pageObject->handleSearchRequest();
$pageObject->render();