<?php
require 'NNGames/Controllers/AdminController.php';

class AdminControllerTest extends \PHPUnit\Framework\TestCase {
    private $adminController;

    public function setUp() {
        $this->adminController = new \NNGames\Controllers\AdminController(); 
    }

    /* AdminController Tests */
    // Home Page Test
    public function testHome() {        
        $array = $this->adminController->home();

        $this->assertEquals('Admin Panel', $array['title']);
    }

    // Access Restricted Page Test
    public function testAccessRestricted() {        
        $array = $this->adminController->accessRestricted();

        $this->assertEquals('Admin Panel - Access Restricted', $array['title']);
    }
}
?>