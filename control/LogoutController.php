<?php

class LogoutController {
    public function logout(): void {
        (new Session())->destroy();
    }
}
