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

    public function listUsers() {
        $users = $this->usersTable->retrieveAllRecords();

        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/users.html.php',
            'variables' => [
                'users' => $users
            ],
            'title' => 'Admin Panel - Users'
        ];
    }

    // Method for displaying the login page.
    public function loginForm() {
        //session_start();
        // Check whether the user is already logged in. If not, return the form.
        if (!isset($_SESSION['isLoggedIn'])) {
            return [ 
                'layout' => 'layout.html.php',
                'template' => 'pages/main/forms/loginform.html.php',
                'variables' => [],
                'title' => 'Sign In'
            ];
        }
        else {
            header('Location: /');
        }
    }

    // Method for displaying the register page.
    public function registerForm() {
        $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

        if (rtrim($route, '/') == "/myaccount") {
            $pageName = 'My Account';
            $layout = 'layout.html.php';            
            $template = 'pages/main/forms/registerform.html.php';
        }
        else {
            $pageName = 'Sign Up';
            $layout = 'layout.html.php';
            $template = 'pages/main/forms/registerform.html.php';
        }
        
        // Check whether the user is already logged in. If not, return the form.
        if (!isset($_SESSION['isLoggedIn'])) {
            return [ 
                'layout' => $layout,
                'template' => $template,
                'variables' => [
                    'pageName' => $pageName
                ],
                'title' => $pageName
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

                if ($user[0]->user_type == 2)
                    $_SESSION['isOwner'] = true;
                else if ($user[0]->user_type == 1)
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
                    'template' => 'pages/main/forms/loginform.html.php',
                    'variables' => [
                        'error' => $error
                    ],
                    'title' => 'Sign In'
                ];
            }
        }
    }

    public function editUserForm() {
        if (!isset($this->get['id']))
            $pageName = 'Add User';
        else
            $pageName = 'Edit User';

        // Check if $_GET['id'] has been set. If so, display
        // a pre-filled edit user (Edit User) form.
        if (isset($this->get['id'])) {
            $user = $this->usersTable->retrieveRecord('user_id', $this->get['id'])[0];

            if (empty($user))
                header('Location: /admin/users');

            // Check if the user has permission to access the details of another user.
            // Redirect the user back to /admin/users if not.
            if (!empty($user) && (isset($_SESSION['isOwner'])) || $this->get['id'] == $_SESSION['id'] || isset($_SESSION['isAdmin']) && $user->user_type == 0) {
                return [
                    'layout' => 'adminlayout.html.php',
                    'template' => 'pages/admin/edituser.html.php',
                    'variables' => [
                        'user' => $user,
                        'pageName' => $pageName
                    ],
                    'title' => 'Admin Panel - ' . $pageName
                ];
            }
            else
                header('Location: /admin/users');
        }
        else {
            return [
                'layout' => 'adminlayout.html.php',
                'template' => 'pages/admin/edituser.html.php',
                'variables' => [
                    'pageName' => $pageName
                ],
                'title' => 'Admin Panel - ' . $pageName
            ];        
        }
    }

    // Function for submitting the edit user form.
    public function editUserSubmit() {
        $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

        if (isset($this->post['submit'])) {
            if (isset($this->get['id'])) {
                $user = $this->usersTable->retrieveRecord('user_id', $this->get['id'])[0];

                if (empty($user))
                    header('Location: /admin/users');
            }
            else
                $user = '';

            $errors = [];

            // Validate user input
            if ($this->post['user']['username'] != '') {
                $existingUsername = $this->usersTable->retrieveRecord('username', htmlspecialchars(strip_tags($this->post['user']['username']), ENT_QUOTES, 'UTF-8'));
                
                if ($route == 'admin/users/edit' && isset($this->get['id'])) {
                    $currentUsername = $this->usersTable->retrieveRecord('user_id', $this->get['id'])[0]->username;

                    if (!empty($existingUsername) && htmlspecialchars(strip_tags($this->post['user']['username']), ENT_QUOTES, 'UTF-8') != $currentUsername)
                        $errors[] = 'The specified username already is already in use.';
                }
                else if ($route == 'register' || $route == 'admin/users/edit' && !isset($this->get['id'])) {
                    if (!empty($existingUsername))
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
                        $currentEmail = $this->usersTable->retrieveRecord('user_id', $this->get['id'])[0]->email;
    
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

            if ($route == 'register') {
                if ($this->post['user']['password'] != '') {
                    if (isset($this->post['user']['confirm-password']) && $this->post['user']['confirm-password'] != $this->post['user']['password'])
                        $errors[] = 'The passwords do not match.';
                }
                else {
                    $errors[] = 'The password cannot be blank.';
                }

                if (!isset($this->post['user']['tos-privacy-agreement']) || $this->post['user']['tos-privacy-agreement'] == 2) {
                    $errors[] = 'Account cannot be created as you have not agreed to our Terms of Service and Privacy Policy.';
                }
            }
            else if ($route == 'admin/users/edit' && !isset($this->get['id'])) {
                if ($this->post['user']['password'] == '')
                    $errors[] = 'The password cannot be blank.';
            }

            // Create new user account if there are no errors.
            if (count($errors) == 0) {
                if ($route == "admin/users/edit") {
                    $pageName = 'User Created';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/success/editusersuccess.html.php';
                }
                else if ($route == "myaccount") {
                    $pageName = 'My Account';
                    $layout = 'layout.html.php';
                    $template = 'pages/main/success/updateuser.html.php';
                }
                else {
                    $pageName = 'Account Created';
                    $layout = 'layout.html.php';
                    $template = 'pages/main/success/registersuccess.html.php';
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
                if ($route == "admin/users/edit" && isset($this->get['id'])) {
                    $pageName = 'Edit User';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/forms/edituserform.html.php';
                }
                else if ($route == "admin/users/edit" && !isset($this->get['id'])) {
                    $pageName = 'Add User';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/forms/edituserform.html.php';
                }
                else if ($route == "myaccount") {
                    $pageName = 'My Account';
                    $layout = 'layout.html.php';
                    $template = 'pages/main/forms/registerform.html.php';
                }
                else {
                    $pageName = 'Sign Up';
                    $layout = 'layout.html.php';
                    $template = 'pages/main/forms/registerform.html.php';
                }
                
                $variables = [
                    'pageName' => $pageName,
                    'error' => $errors[0],
                    'user' => $user
                ];
            }
        }

        return [
            'layout' => $layout,
            'template' => $template,
            'variables' => $variables,
            'title' => $pageName
        ];
    }

    // Function for deleting a user from the database.
    public function deleteUser() {
        $this->usersTable->deleteRecordById($this->post['user']['user_id']);

        header('Location: /admin/users');
    }

    // Function for logging the user out from the website.
    public function logout() {   
        if (isset($_SESSION['isLoggedIn'])) {
            // Unset all $_SESSION variables.
            unset($_SESSION['isLoggedIn']);
            unset($_SESSION['isOwner']);
            unset($_SESSION['isAdmin']);
            unset($_SESSION['isCustomer']);
            unset($_SESSION['basket']);
            unset($_SESSION['username']);
            unset($_SESSION['id']);
    
            return [
                'layout' => 'layout.html.php',
                'template' => 'pages/main/success/logoutsuccess.html.php',
                'variables' => [],
                'title' => 'Log out'
            ];
        }
        else 
            header('Location: /login');
    }
}
?>