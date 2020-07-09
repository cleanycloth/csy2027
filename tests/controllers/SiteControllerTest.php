<?php
require 'NNGames/Controllers/SiteController.php';

class SiteControllerTest extends \PHPUnit\Framework\TestCase {
    private $siteController;

    public function setUp() {
        $this->siteController = new \NNGames\Controllers\SiteController(); 
    }

    /* SiteController Tests */
    // Home Page Test
    public function testHome() {        
        $array = $this->siteController->home([null, null]);

        $this->assertEquals('Home', $array['title']);
    }

    // Error Pages Tests
    public function testError400() {
        $array = $this->siteController->error400();

        $this->assertEquals('Error 400: Bad Request', $array['title']);
    } 

    public function testError401() {
        $array = $this->siteController->error401();

        $this->assertEquals('Error 401: Unauthorised', $array['title']);
    } 

    public function testError403() {
        $array = $this->siteController->error403();

        $this->assertEquals('Error 403: Forbidden', $array['title']);
    } 

    public function testError404() {
        $array = $this->siteController->error404();

        $this->assertEquals('Error 404: Not Found', $array['title']);
    } 

    public function testError500() {
        $array = $this->siteController->error500();

        $this->assertEquals('Error 500: Server Error', $array['title']);
    } 
}
?>