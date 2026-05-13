<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../bootstrap.php';

require_once __DIR__ . '/../control/loginDNController.php';
require_once __DIR__ . '/../control/loginFRController.php';
require_once __DIR__ . '/../control/loginPMController.php';
require_once __DIR__ . '/../control/loginUAController.php';
require_once __DIR__ . '/../control/LogoutController.php';

class AuthenticationTest extends TestCase
{
	// Success Login Test
    public function testDNLoginSuccess()
    {
        $controller = new loginDNController();

        $result = $controller->login("donee1", "1234");

        $this->assertTrue($result);
    }

    public function testFRLoginSuccess()
    {
        $controller = new loginFRController();

        $result = $controller->login("fundraiser1", "1234");

        $this->assertTrue($result);
    }

    public function testPMLoginSuccess()
    {
        $controller = new loginPMController();

        $result = $controller->login("pm1", "1234");

        $this->assertTrue($result);
    }

    public function testUALoginSuccess()
    {
        $controller = new loginUAController();

        $result = $controller->login("useradmin1", "1234");

        $this->assertTrue($result);
    }
	
	// Fail Login Test
    public function testDNLoginFail()
    {
        $controller = new loginDNController();

        $result = $controller->login("ua1", "1234");

        $this->assertFalse($result);
    }

    public function testFRLoginFail()
    {
        $controller = new loginFRController();

        $result = $controller->login("fr1", "5432");

        $this->assertFalse($result);
    }

    public function testPMLoginFail()
    {
        $controller = new loginPMController();

        $result = $controller->login("fguser1", "1234");

        $this->assertFalse($result);
    }

    public function testUALoginFail()
    {
        $controller = new loginUAController();

        $result = $controller->login("uauser1", "1144");

        $this->assertFalse($result);
    }
	
	// Success Logout Test
    public function testLogout()
	{
		$_SESSION['user_id'] = 1;

		$controller = new LogoutController();

		$controller->logout();

		$this->assertEmpty($_SESSION);
	}
}