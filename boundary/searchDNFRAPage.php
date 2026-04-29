<?php

require_once __DIR__ . '/../control/searchDNFRAController.php';

class searchDNFRAPage
{
    private searchDNFRAController $controller;
    private string $searchKeyword = '';
    private array $results = [];

    public function __construct()
    {
        $this->controller = new searchDNFRAController();
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

    $popupMessage = '';
    $popupType = '';

    if (isset($_GET['success']) && $_GET['success'] === 'saved') {
        $popupMessage = '1 activity successfully saved.';
        $popupType = 'success';
    }

    if (isset($_GET['error']) && $_GET['error'] === 'exists') {
        $popupMessage = 'The activity is already in the favourite list.';
        $popupType = 'error';
    }

    $activePage = 'browse_fra';
    $pageTitle = 'FRA Search';

    $contentView = __DIR__ . '/views/search_dn_fra.view.php';

    include __DIR__ . '/views/layout_dn.view.php';
}
}

$pageObject = new searchDNFRAPage();
$pageObject->handleSearchRequest();
$pageObject->render();