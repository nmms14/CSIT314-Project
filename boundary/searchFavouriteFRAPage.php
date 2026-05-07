<?php

require_once __DIR__ . '/../control/searchFavouriteFRAController.php';

class searchFavouriteFRAPage
{
    private searchFavouriteFRAController $controller;
    private string $searchKeyword = '';
    private array $activities = [];

    public function __construct()
    {
        $this->controller = new searchFavouriteFRAController();
    }

    public function display(): void
    {
        $this->searchKeyword = trim($_GET['keyword'] ?? '');

        $this->activities = $this->controller->searchFavouriteFRAid($this->searchKeyword);

        $searchKeyword = $this->searchKeyword;
        $activities = $this->activities;

        $pageTitle = 'Favourite Fundraising Activities';
        $activePage = 'favourite_fra';

        $contentView = __DIR__ . '/views/view_favourite_fra.view.php';

        include __DIR__ . '/views/layout_dn.view.php';
    }
}
