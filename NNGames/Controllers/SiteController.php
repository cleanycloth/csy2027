<?php
namespace NNGames\Controllers;
class SiteController {
    // Function for displaying the home page.
    public function home() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'home.html.php',
            'variables' => [],
            'title' => 'NNGames - Home'
        ];
    }

    // Method for displaying the login page.
    public function login() {
        return [ 
            'layout' => 'layout.html.php',
            'template' => 'login.html.php',
            'variables' => [],
            'title' => 'NNGames - Login'
        ];
    }

    // Method for returning a test JSON response.
    public function testResponse() {
        $testArray[0] = 'test 1';
        $testArray[1] = 'test 2';
        $testArray[2] = [
            'field1' => '1',
            'field2' => '2'
        ];

        return [
            'layout' => 'blanklayout.html.php',
            'template' => 'json/response.html.php',
            'variables' => [
                'jsonResponse' => json_encode($testArray)
            ],
            'title' => 'NNGames - Test Response'
        ];
    }
}
?>