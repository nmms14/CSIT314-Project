<?php

require_once __DIR__ . '/../control/viewNumFRAController.php';

class viewNumFRAPage
{
    public function display(): void
    {
        $controller = new viewNumFRAController();

        $fraList = $controller->getViewed($_GET);

        $totalViews = 0;
        $mostViewedFRA = '-';

        foreach ($fraList as $fra) {
            $totalViews += (int)($fra['view_count'] ?? 0);
        }

        $mostViewedFRA = '-';

        if (!empty($fraList) && $fraList[0]['view_count'] > 0) {
        $mostViewedFRA = $fraList[0]['campaign_title'];
        }

        $pageTitle = 'View Statistics';
        $activePage = 'view_statistics';
        $contentView = __DIR__ . '/views/view_num_fra.view.php';

        include __DIR__ . '/views/layout_fr.view.php';
    }
}