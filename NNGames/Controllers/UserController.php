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
    public function loginForm() {
        //session_start();
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
    public function editUserForm() {
        $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

        if (rtrim($route, '/') == "/admin") {
            $pageName = 'Edit Account';
            $layout = 'layout.html.php';
            $template = 'forms/registerform.html.php';
        }
        else if (rtrim($route, '/') == "/myaccount") {
            $pageName = 'My Account';
            $layout = 'layout.html.php';            
            $template = 'forms/registerform.html.php';
        }
        else {
            $pageName = 'Sign Up';
            $layout = 'layout.html.php';
            $template = 'forms/registerform.html.php';
        }

        session_start();
        // Check whether the user is already logged in. If not, return the form.
        if (!isset($_SESSION['isLoggedIn'])) {
            return [ 
                'layout' => $layout,
                'template' => $template,
                'variables' => [
                    'pageName' => $pageName
                ],
                'title' => 'NNGames - ' . $pageName
            ];
        }
        else {
            header('Location: /');
        }
    }

    // Method for authenticating the user.
    public function loginSubmit() {
        if (isset($this->post['submit'])) {
            $user = $this->usersTable->retrieveRecord('username', $this->post['login']['username']);

            $username = strtolower($this->post['login']['username']);
            $password = $this->post['login']['password'];
            $passwordWithUsername = $username . $password;

            $error = '';

            if ($username != '' && $password != '')
                if (!empty($user)) {
                    if (password_verify($passwordWithUsername, $user[0]->password) == true) {
                        if ($user[0]->activated == 0)
                            $error = 'Your account has not been activated. Please contact an administrator.';
                    }
                    else
                        $error = 'The password provided is incorrect.';
                }
                else
                    $error = 'A user with the username provided does not exist.';
            else
                $error = 'You have not provided a username and/or password.';

            // Check if the $error variable has no value. If so,
            // log the user into the system and set roles accordingly.
            if ($error == '') {
                //session_start();

                if ($user[0]->user_type == 1)
                    $_SESSION['isAdmin'] = true;
                else
                    $_SESSION['isCustomer'] = true;

                $_SESSION['username'] = $user[0]->username;
                $_SESSION['id'] = $user[0]->user_id;

                $_SESSION['isLoggedIn'] = true;
                header('Location: /');
            }
            else {
                return [
                    'layout' => 'layout.html.php',
                    'template' => 'forms/loginform.html.php',
                    'variables' => [
                        'error' => $error
                    ],
                    'title' => 'NNGames - Sign In'
                ];
            }
        }
    }

    // Function for submitting the edit user form.
    public function editUserSubmit() {
        if (isset($this->post['submit'])) {
            if (isset($this->get['id']))
                $user = $this->usersTable->retrieveRecord('user_id', $this->get['id'])[0];
            else
                $user = '';

            $errors = [];

            // Validate user input
            if ($this->post['user']['username'] != '') {
                $existingUsername = $this->usersTable->retrieveRecord('username', htmlspecialchars(strip_tags($this->post['user']['username']), ENT_QUOTES, 'UTF-8'));
                
                if (isset($this->get['id'])) {
                    $currentUsername = $this->usersTable->retrieveRecord('id', $this->get['id'])[0]->username;

                    if (!empty($existingUsername) && htmlspecialchars(strip_tags($this->post['user']['username']), ENT_QUOTES, 'UTF-8') != $currentUsername)
                        $errors[] = 'The specified username already is already in use.';
                }
            }
            else
               $errors[] = 'The username cannot be blank.';

            if ($this->post['user']['firstname'] == '')
                $errors[] = 'The first name cannot be blank.';

            if ($this->post['user']['surname'] == '')
                $errors[] = 'The surname cannot be blank.';

            if ($this->post['user']['email'] != '') {
                if (filter_var($this->post['user']['email'], FILTER_VALIDATE_EMAIL)) {
                    $existingEmail = $this->usersTable->retrieveRecord('email', $this->post['user']['email']);

                    if (isset($this->get['id'])) {
                        $currentEmail = $this->usersTable->retrieveRecord('id', $this->get['id'])[0]->email;
    
                        if (!empty($existingEmail) && $this->post['user']['email'] != $currentEmail)
                            $errors[] = 'The specified email address is already in use.';
                    }
                    else {
                        if (!empty($existingEmail))
                            $errors[] = 'The specified email address is already in use.';
                    }
                }
                else
                    $errors[] = 'The email address is invalid.';
            }
            else
                $errors[] = 'The email address cannot be blank.';
            
            if (!isset($this->get['id']) && $this->post['user']['password'] != '') {
                if (isset($this->post['user']['confirm-password']) && $this->post['user']['confirm-password'] != $this->post['user']['password'])
                    $errors[] = 'The passwords do not match.';
            }
            else
                $errors[] = 'The password cannot be blank.';

            if (!isset($this->post['user']['tos-privacy-agreement']) || $this->post['user']['tos-privacy-agreement'] == 2) {
                $errors[] = 'Account cannot be created as you have not agreed to our Terms of Service and Privacy Policy.';
            }

            // Create new user account if there are no errors.
            if (count($errors) == 0) {
                $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

                if (rtrim($route, '/') == "/admin") {
                    $pageName = 'Edit Account';
                    $template = 'success/updateuseradmin.html.php';
                }
                else if (rtrim($route, '/') == "/myaccount") {
                    $pageName = 'My Account';
                    $template = 'success/updateuser.html.php';
                }
                else {
                    $pageName = 'Account Created';
                    $template = 'success/registersuccess.html.php';
                }

                $this->post['user']['username'] = strtolower(htmlspecialchars(strip_tags($this->post['user']['username']), ENT_QUOTES, 'UTF-8'));
                $this->post['user']['firstname'] = htmlspecialchars(strip_tags($this->post['user']['firstname']), ENT_QUOTES, 'UTF-8');
                $this->post['user']['surname'] = htmlspecialchars(strip_tags($this->post['user']['surname']), ENT_QUOTES, 'UTF-8');
            
                if (isset($this->get['id']) && $this->post['user']['password'] == '')
                    unset($this->post['user']['password']);
                else
                    $this->post['user']['password'] = password_hash($this->post['user']['username'] . $this->post['user']['password'], PASSWORD_DEFAULT);

                if (isset($this->post['user']['confirm-password']))
                    unset($this->post['user']['confirm-password']);

                if (isset($this->post['user']['tos-privacy-agreement']))
                    unset($this->post['user']['tos-privacy-agreement']);

                $this->usersTable->save($this->post['user']);
                //$this->usersTable->insertRecord($this->post['user']);

                $variables = [
                    'pageName' => $pageName,
                    'username' => htmlspecialchars(strip_tags($this->post['user']['username']), ENT_QUOTES, 'UTF-8')
                ];
            }
            // Display the registration form with any generated errors.
            else {
                $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

                if (rtrim($route, '/') == "/admin") {
                    $pageName = 'Edit Account';
                    $template = 'forms/registerform.html.php';
                }
                else if (rtrim($route, '/') == "/myaccount") {
                    $pageName = 'My Account';
                    $template = 'forms/registerform.html.php';
                }
                else {
                    $pageName = 'Sign Up';
                    $template = 'forms/registerform.html.php';
                }

                $template = 'forms/registerform.html.php';
                
                $variables = [
                    'pageName' => $pageName,
                    'error' => $errors[0],
                    'user' => $user
                ];
            }
        }

        return [
            'layout' => 'layout.html.php',
            'template' => $template,
            'variables' => $variables,
            'title' => 'NNGames - ' . $pageName
        ];
    }

    // Function for logging the user out from the website.
    public function logout() {   
        if (isset($_SESSION['isLoggedIn'])) {
            // Unset all $_SESSION variables.
            unset($_SESSION['isLoggedIn']);
            unset($_SESSION['isAdmin']);
            unset($_SESSION['isCustomer']);
            unset($_SESSION['username']);
            unset($_SESSION['id']);
    
            return [
                'layout' => 'layout.html.php',
                'template' => 'success/logoutsuccess.html.php',
                'variables' => [],
                'title' => 'Log out'
            ];
        }
        else 
            header('Location: /login');
    }
}
?>