<?php
require 'CSY2028/EntryPoint.php';
require 'CSY2028/Routes.php';

class EntryPointTest extends \PHPUnit\Framework\TestCase {
    /* EntryPoint Tests */
    // run() Tests
    function testRun404() {
        // Define $_SERVER variables.
        $_SERVER['REQUEST_URI'] = 'test';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        // Create mock controller.
        $mockController = $this->getMockBuilder('\NNGames\Controllers\SiteController')->disableOriginalConstructor()->getMock();

        // Define routes data.
        $routes = [
            '' => [
                'GET' => [
                    'controller' => $mockController,
                    'function' => 'home'
                ],
                'login' => true,
                'restricted' => true
            ]
        ];

        // Create mock routes class.
        $mockRoutes = $this->getMockBuilder('\CSY2028\Routes')->disableOriginalConstructor()->getMock();
        $mockRoutes->expects($this->once())
            ->method('getRoutes')
            ->will($this->returnValue($routes));

        // Declare EntryPoint instance and execute the run() method.
        $entryPoint = new \CSY2028\EntryPoint($mockRoutes); 
        $result = $entryPoint->run();
        
        // Check if page was redirected to the 404 page.
        $this->assertFalse($result);
    }

    function testRunNoParams() {
        // Define $_SERVER variables.
        $_SERVER['REQUEST_URI'] = '';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        // Create mock controller.
        $mockController = $this->getMockBuilder('\NNGames\Controllers\SiteController')->disableOriginalConstructor()->getMock();
        $mockController->expects($this->once())
            ->method('home')
            ->will($this->returnValue([
                'layout' => 'phpunit/layout.html.php',
                'template' => 'phpunit/home.html.php',
                'variables' => [],
                'title' => 'Home'
            ]));

        // Define routes data.
        $routes = [
            '' => [
                'GET' => [
                    'controller' => $mockController,
                    'function' => 'home'
                ],
                'login' => true,
                'restricted' => true
            ]
        ];

        // Create mock routes class.
        $mockRoutes = $this->getMockBuilder('\CSY2028\Routes')->disableOriginalConstructor()->getMock();
        $mockRoutes->expects($this->once())
            ->method('getRoutes')
            ->will($this->returnValue($routes));
        $mockRoutes->expects($this->once())
            ->method('getTemplateVariables')
            ->will($this->returnValue([]));
        
        // Declare EntryPoint instance and execute the run() method.
        $entryPoint = new \CSY2028\EntryPoint($mockRoutes); 
        $result = $entryPoint->run();

        // Check if page was not redirected to the 404 page.
        $this->assertTrue($result);
    }

    function testRunWithParams() {
        // Define $_SERVER variables.
        $_SERVER['REQUEST_URI'] = '';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        // Create mock controller.
        $mockController = $this->getMockBuilder('\NNGames\Controllers\SiteController')->disableOriginalConstructor()->getMock();
        $mockController->expects($this->once())
            ->method('home')
            ->will($this->returnValue([
                'layout' => 'phpunit/layout.html.php',
                'template' => 'phpunit/home.html.php',
                'variables' => [],
                'title' => 'Home'
            ]));

        // Define routes data.
        $routes = [
            '' => [
                'GET' => [
                    'controller' => $mockController,
                    'function' => 'home',
                    'parameters' => ['param1', 'param2']
                ],
                'login' => true,
                'restricted' => true
            ]
        ];

        // Create mock routes class.
        $mockRoutes = $this->getMockBuilder('\CSY2028\Routes')->disableOriginalConstructor()->getMock();
        $mockRoutes->expects($this->once())
            ->method('getRoutes')
            ->will($this->returnValue($routes));
        $mockRoutes->expects($this->once())
            ->method('getTemplateVariables')
            ->will($this->returnValue([]));
        
        // Declare EntryPoint instance and execute the run() method.
        $entryPoint = new \CSY2028\EntryPoint($mockRoutes); 
        $result = $entryPoint->run();

        // Check if page was not redirected to the 404 page.
        $this->assertTrue($result);
    }
}
?>