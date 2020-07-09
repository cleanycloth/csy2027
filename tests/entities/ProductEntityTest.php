<?php
require 'NNGames/Entities/Product.php';
require 'CSY2028/DatabaseTable.php';
class ProductEntityTest extends \PHPUnit\Framework\TestCase {
    private $productsTable;

    public function setUp() {
        $this->pdo = $pdo;
        $this->usersTable = new \CSY2028\DatabaseTable($pdo, 'users', 'user_id');
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