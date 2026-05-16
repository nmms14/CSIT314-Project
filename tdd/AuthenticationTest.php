<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../bootstrap.php';

require_once __DIR__ . '/../boundary/loginDNPage.php';
require_once __DIR__ . '/../boundary/loginFRPage.php';
require_once __DIR__ . '/../boundary/loginPMPage.php';
require_once __DIR__ . '/../boundary/loginUAPage.php';
require_once __DIR__ . '/../boundary/LogoutPage.php';

class AuthenticationTest extends TestCase
{
	// Success Login Test
    public function testDNLoginSuccess()
    {
		echo "Testing DN successful login..." . PHP_EOL;
		
        $page = new loginDNPage();

		$result = $page->login("donee", "donee123");

		$this->assertEquals('dashboard_dn.php', $result);
		
		echo "Passed" . PHP_EOL;
    }

    public function testFRLoginSuccess()
    {
		echo "Testing FR successful login..." . PHP_EOL;
		
        $page = new loginFRPage();

		$result = $page->login("fundraiser", "fundraiser123");

		$this->assertEquals('dashboard_fr.php', $result);
		
		echo "Passed" . PHP_EOL;
    }

    public function testPMLoginSuccess()
    {
		echo "Testing PM successful login..." . PHP_EOL;
		
        $page = new loginPMPage();

		$result = $page->login("manager", "manager123");

		$this->assertEquals('dashboard_pm.php', $result);
		
		echo "Passed" . PHP_EOL;
    }

    public function testUALoginSuccess()
    {
		echo "Testing UA successful login..." . PHP_EOL;
		
        $page = new loginUAPage();

        $result = $page->login("useradmin", "useradmin123");

        $this->assertEquals('dashboard_ua.php', $result);
		
		echo "Passed" . PHP_EOL;
    }
	
	// Fail Login Test
    public function testDNLoginFail()
    {
		echo "Testing Donee fail login..." . PHP_EOL;
		
        $page = new loginDNPage();

        $result = $page->login("invaliddn", "1234");

        $this->assertNull($result);
		
		echo "Passed" . PHP_EOL;
    }

    public function testFRLoginFail()
    {
		echo "Testing FR fail login..." . PHP_EOL;
		
        $page = new loginFRPage();

        $result = $page->login("invalidfr", "5432");

        $this->assertNull($result);
		
		echo "Passed" . PHP_EOL;
    }

    public function testPMLoginFail()
    {
		echo "Testing PM fail login..." . PHP_EOL;
		
        $page = new loginPMPage();

        $result = $page->login("invalidpm", "1234");

		$this->assertNull($result);
		
		echo "Passed" . PHP_EOL;
    }

    public function testUALoginFail()
    {
		echo "Testing UA fail login..." . PHP_EOL;
		
        $page = new loginUAPage();

        $result = $page->login("invalidua", "1144");

		$this->assertNull($result);
		
		echo "Passed" . PHP_EOL;
    }
	
	// Success Logout Test
    public function testLogout()
	{
		echo "Testing successful logout..." . PHP_EOL;
		
		$_SESSION['user_id'] = 1;

		$page = new LogoutPage();

		$result = $page->requestLogout();

		$this->assertEmpty($_SESSION);

		$this->assertEquals('index.php?logged_out=1', $result);
		
		echo "Passed" . PHP_EOL;
	}
}