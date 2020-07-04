<?php
namespace NNGames\Controllers;
class UserController {
    private $usersTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $usersTable, $get, $post) {
        $this->usersTable = $usersTable;
        $this->get = $get;
        $this->post = $post;
    }

    // Method for displaying the login page.
    public function login() {
        session_start();
        // Check whether the user is already logged in. If not, return the form.
        if (!isset($_SESSION['isLoggedIn'])) {
            return [ 
                'layout' => 'layout.html.php',
                'template' => 'forms/loginform.html.php',
                'variables' => [],
                'title' => 'NNGames - Sign In'
            ];
        }
        else {
            header('Location: /');
        }
    }

    // Method for displaying the register page.
    public function register() {
        session_start();
        // Check whether the user is already logged in. If not, return the form.
        if (!isset($_SESSION['isLoggedIn'])) {
            return [ 
                'layout' => 'layout.html.php',
                'template' => 'forms/registerform.html.php',
                'variables' => [],
                'title' => 'NNGames - Sign Up'
            ];
        }
        else {
            header('Location: /');
        }
    }
}
?>