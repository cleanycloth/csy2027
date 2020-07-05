<?php
namespace NNGames\Controllers;
class SiteController {
    // Function for displaying the home page.
    public function home() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'home.html.php',
            'variables' => [],
            'title' => 'Home'
        ];
    }

    // Method for displaying the login page.
    public function login() {
        return [ 
            'layout' => 'layout.html.php',
            'template' => 'login.html.php',
            'variables' => [],
            'title' => 'Login'
        ];
    }

    // Method for returning a test JSON response.
    public function testResponse() {
        $testArray['status'] = "User Created";

        return [
            'layout' => 'blanklayout.html.php',
            'template' => 'json/response.html.php',
            'variables' => [
                'jsonResponse' => json_encode($testArray)
            ],
            'title' => 'Test Response'
        ];
    }

    // Error Page Methods
    public function error400() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'errors/400.html.php',
            'variables' => [],
            'title' => 'Error 400: Bad Request'
        ];
    }

    public function error401() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'errors/401.html.php',
            'variables' => [],
            'title' => 'Error 401: Unauthorised'
        ];
    }

    public function error403() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'errors/403.html.php',
            'variables' => [],
            'title' => 'Error 403: Forbidden'
        ];
    }

    public function error404() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'errors/404.html.php',
            'variables' => [],
            'title' => 'Error 404: Not Found'
        ];
    }

    public function error500() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'errors/500.html.php',
            'variables' => [],
            'title' => 'Error 500: Server Error'
        ];
    }
}
?>