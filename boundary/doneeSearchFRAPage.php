<?php

require_once __DIR__ . '/../control/doneeSearchFRAController.php';

class doneeSearchFRAPage
{
    private doneeSearchFRAController $controller;
    private string $searchKeyword = '';
    private array $results = [];

    public function __construct()
    {
        $this->controller = new doneeSearchFRAController();
    }

    public function handleSearchRequest(): void
    {
        $this->searchKeyword = trim($_GET['keyword'] ?? '');

        $this->displayMatchingResults();
    }

    public function displayMatchingResults(): void
    {
        $this->results = $this->controller->processSearch($this->searchKeyword);
    }

    public function render(): void
    {
        $searchKeyword = $this->searchKeyword;
        $results = $this->results;

        $activePage = 'browse_fra';
        $pageTitle = 'Browse FRA';

        $contentView = __DIR__ . '/views/donee_search_fra.view.php';

        include __DIR__ . '/views/layout_dn.view.php';
    }
}

$pageObject = new doneeSearchFRAPage();
$pageObject->handleSearchRequest();
$pageObject->render();