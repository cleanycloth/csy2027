<?php
require 'NNGames/Routes.php';

class RoutesTest extends \PHPUnit\Framework\TestCase {
    private $routes;

    public function setUp() {
        $this->routes = new \NNGames\Routes(); 
    }

    /* Routes Tests - !!! ALL TESTS BELOW REQUIRE A DATABASE CONNECTION !!! */
    // getRoutes() Test
    function testGetRoutes() {
        $result = $this->routes->getRoutes();

        $this->assertNotEmpty($result['login']);
    }

    // getTemplateVariables() Test
    function testGetTemplateVariables() {
        $this->routes->getRoutes();
        $result = $this->routes->getTemplateVariables();

        $this->assertEquals('PlayStation', $result['categories'][0]->name);
    }

    // checkLogin() Test
    function testCheckLogin() {
        $this->routes->checkLogin();

        $this->assertContains('Location: /login', xdebug_get_headers());
    }
    
    // checkAccess() Tests
    function testCheckAccessNoPermission() {
        $this->routes->getRoutes();
        $this->routes->checkAccess();

        $this->assertContains('Location: /admin/access-restricted', xdebug_get_headers());
    }

    function testCheckAccessWithPermission() {
        $_SESSION['isOwner'] = true;

        $this->routes->getRoutes();
        $result = $this->routes->checkAccess();

        $this->assertTrue($result);

        unset($_SESSION['isOwner']);
    }

    // updateRole() Tests
    function testUpdateRoleOwner() {
        $_SESSION['id'] = 1;

        $this->routes->getRoutes();
        $this->routes->updateRole();

        $this->assertArrayHasKey('isOwner', $_SESSION);
    }

    function testUpdateRoleAdmin() {
        $_SESSION['id'] = 2;

        $this->routes->getRoutes();
        $this->routes->updateRole();

        $this->assertArrayHasKey('isAdmin', $_SESSION);        
    }

    function testUpdateRoleCustomer() {
        $_SESSION['id'] = 3;

        $this->routes->getRoutes();
        $this->routes->updateRole();

        $this->assertArrayHasKey('isCustomer', $_SESSION);            
    }
}
?>