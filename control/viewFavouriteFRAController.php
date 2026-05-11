<?php
require_once __DIR__ . '/../entity/FavouriteFundraisingActivity.php';

class viewFavouriteFRAController {
	
	public FavouriteFundraisingActivity $fav;
	
	 public function __construct()
    {
        $this->fav = new FavouriteFundraisingActivity();
    }
	
    public function viewFavouriteFRA(string $username): array {
        return $this->fav->viewFavouriteFRA($username);
    }
}