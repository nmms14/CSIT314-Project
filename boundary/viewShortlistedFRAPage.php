<?php

require_once __DIR__ . '/../control/viewShortlistedFRAController.php';

class viewShortlistedFRAPage
{
    public function display(): void
    {
        $controller = new viewShortlistedFRAController();

        $fraList = $controller->getShortlisted($_GET);

        $totalShortlists = 0;
        $mostShortlistedFRA = '-';

        foreach ($fraList as $fra) {
            $totalShortlists += (int)($fra['shortlist_count'] ?? 0);
        }

        if (!empty($fraList) && $fraList[0]['shortlist_count'] > 0) {
            $mostShortlistedFRA = $fraList[0]['campaign_title'];
        }

        $pageTitle = 'View Shortlist';
        $activePage = 'view_shortlist';
        $contentView = __DIR__ . '/views/view_shortlisted_fra.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}