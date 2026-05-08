<?php

require_once __DIR__ . '/../control/viewDonationHistoryController.php';
require_once __DIR__ . '/../control/searchDonationHistoryController.php';

class donationHistoryPage
{
	private viewDonationHistoryController $viewController;
    private searchDonationHistoryController $searchController;

    public function __construct()
    {
		$this->viewController = new viewDonationHistoryController();
        $this->searchController = new searchDonationHistoryController();
    }

    public function display(): void
    {
        $keyword = $_GET['keyword'] ?? '';

        if ($keyword !== '') {

            $results =
                $this->searchController
                     ->searchDonationHistory($keyword);

        } else {

            $results =
                $this->viewController
                     ->getAllDonationHistory();
        }

        $searchKeyword = $keyword;

        $contentView = __DIR__ . '/views/search_donation_history.view.php';

		include __DIR__ . '/views/layout_dn.view.php';
    }
}

$page = new donationHistoryPage();
$page->display();