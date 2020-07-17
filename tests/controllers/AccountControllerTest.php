<?php
require 'NNGames/Controllers/AccountController.php';

class AccountControllerTest extends \PHPUnit\Framework\TestCase {
    private $accountController;

    public function setUp() {
        $this->accountController = new \NNGames\Controllers\AccountController(); 
    }

    /* AccountController Tests */
    // mainView() Test
    public function testMainView() {        
        $array = $this->accountController->mainView();

        $this->assertEquals('My Account', $array['title']);
    }

    // adddresses() Test
    public function testAddresses() {        
        $array = $this->accountController->addresses();

        $this->assertEquals('My Account - Addresses', $array['title']);
    }

    // payment() Test
    public function testPayment() {        
        $array = $this->accountController->payment();

        $this->assertEquals('My Account - Payment Info', $array['title']);
    }

    // orders() Test
    public function testOrders() {        
        $array = $this->accountController->orders();

        $this->assertEquals('My Account - Order History', $array['title']);
    }

    // settings() Test
    public function testSettings() {        
        $array = $this->accountController->settings();

        $this->assertEquals('My Account - Account Settings', $array['title']);
    }   
}
?>