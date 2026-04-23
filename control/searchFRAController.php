<?php

require_once __DIR__ . '/../entity/FundraisingActivity.php';

class SearchFRAController
{
    private FundraisingActivity $fundraisingActivity;

    public function __construct()
    {
        $this->fundraisingActivity = new FundraisingActivity();
    }

    public function processSearch(string $keyword): array
    {
        $keyword = trim($keyword);

        if ($keyword === '') {
            return [];
        }

        return $this->fundraisingActivity->getMatchingFRA($keyword);
    }
}