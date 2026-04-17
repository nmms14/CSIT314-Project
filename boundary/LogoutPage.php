<?php

class LogoutPage {
    public function requestLogout(): string {
        (new LogoutController())->logout();
        return 'index.php?logged_out=1';
    }
}
