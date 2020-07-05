<?php
namespace NNGames\Controllers;
class AdminController {
    private $usersTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $usersTable, $get, $post) {
        $this->usersTable = $usersTable;
        $this->get = $get;
        $this->post = $post;
    }

    // Function for displaying the admin home page.
    public function home() {
        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/home.html.php',
            'variables' => [],
            'title' => 'Admin Panel'
        ];
    }

    public function users() {
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

    public function editUser() {
        if (!isset($this->get['id']))
            $pageName = 'Add User';
        else
            $pageName = 'Edit User';

        // Check if $_GET['id'] has been set. If so, display
        // a pre-filled edit user (Edit User) form.
        if (isset($this->get['id'])) {
            $user = $this->usersTable->retrieveRecord('user_id', $this->get['id'])[0];

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
                    'title' => 'Admin Panel - Edit User'
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
                'title' => 'Admin Panel - Add User'
            ];        
        }
    }

    public function products() {
        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/products.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Products'
        ];
    }

    public function categories() {
        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/categories.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Categories'
        ];
    }

    public function slides() {
        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/slides.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Slides'
        ];
    }

    public function accessRestricted() {
        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/restricted.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Access Restricted'
        ];
    }
}
?>