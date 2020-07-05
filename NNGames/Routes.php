<?php
namespace NNGames;
class Routes implements \CSY2028\Routes {
    private $usersTable;
    private $categoriesTable;

    public function getRoutes() {
        require '../dbConnection.php';

        // Create new DatabaseTable objects.
        $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'category_id', '\NNGames\Entities\Category');
        $this->usersTable = new \CSY2028\DatabaseTable($pdo, 'users', 'user_id');
        $addressesTable = new \CSY2028\DatabaseTable($pdo, 'addresses', 'address_id');
        $productsTable = new \CSY2028\DatabaseTable($pdo, 'products', 'product_id');
        $productReviewsTable = new \CSY2028\DatabaseTable($pdo, 'product_reviews', 'product_id');
        $platformsTable = new \CSY2028\DatabaseTable($pdo, 'platforms', 'platform_id');
        $genresTable = new \CSY2028\DatabaseTable($pdo, 'genres', 'genre_id');
        $ordersTable = new \CSY2028\DatabaseTable($pdo, 'orders', 'order_id');
        $orderDetailsTable = new \CSY2028\DatabaseTable($pdo, 'order_details', 'order_id');
        $paymentsTable = new \CSY2028\DatabaseTable($pdo, 'payments', 'payment_id');
        $slidesTable = new \CSY2028\DatabaseTable($pdo, 'slides', 'slide_id');

        // Create new controller objects.
        $siteController = new \NNGames\Controllers\SiteController();
        $userController = new \NNGames\Controllers\UserController($this->usersTable, $_GET, $_POST);
        $adminController = new \NNGames\Controllers\AdminController();
        $productController = new \NNGames\Controllers\ProductController($productsTable, $_GET, $_POST);
        $categoryController = new \NNGames\Controllers\CategoryController($this->categoriesTable, $_GET, $_POST);
        $slideController = new \NNGames\Controllers\SlideController($slidesTable, $_GET, $_POST);

        // Define routes.
        $routes = [
            '' => [
                'GET' => [
                    'controller' => $siteController,
                    'function' => 'home',
                    'parameters' => []
                ]
            ],
            'login' => [
                'GET' => [
                    'controller' => $userController,
                    'function' => 'loginForm',
                    'parameters' => []
                ],
                'POST' => [
                    'controller' => $userController,
                    'function' => 'loginSubmit',
                    'parameters' => []
                ]
            ],
            'register' => [
                'GET' => [
                    'controller' => $userController,
                    'function' => 'registerForm',
                    'parameters' => []
                ],
                'POST' => [
                    'controller' => $userController,
                    'function' => 'editUserSubmit',
                    'parameters' => []
                ],
            ],
            'logout' => [
                'GET' => [
                    'controller' => $userController,
                    'function' => 'logout',
                    'parameters' => []
                ]
            ],
            'product' => [
                'GET' => [
                    'controller' => $productController,
                    'function' => 'product',
                    'parameters' => []
                ]
            ],
            // Administration Pages
            'admin' => [
                'GET' => [
                    'controller' => $adminController,
                    'function' => 'home',
                    'parameters' => []
                ],
                'login' => true,
                'restricted' => true
            ],
            'admin/users' => [
                'GET' => [
                    'controller' => $userController,
                    'function' => 'listUsers',
                    'parameters' => []
                ],
                'login' => true,
                'restricted' => true
            ],
            'admin/users/edit' => [
                'GET' => [
                    'controller' => $userController,
                    'function' => 'editUserForm',
                    'parameters' => []
                ],
                'POST' => [
                    'controller' => $userController,
                    'function' => 'editUserSubmit',
                    'parameters' => []
                ],
                'login' => true,
                'restricted' => true
            ],
            'admin/users/delete' => [
                'POST' => [
                    'controller' => $userController,
                    'function' => 'deleteUser',
                    'parameters' => []
                ],
                'login' => true,
                'restricted' => true
            ],
            'admin/products' => [
                'GET' => [
                    'controller' => $productController,
                    'function' => 'listProducts',
                    'parameters' => []
                ],
                'login' => true,
                'restricted' => true
            ],
            'admin/categories' => [
                'GET' => [
                    'controller' => $categoryController,
                    'function' => 'listCategories',
                    'parameters' => []
                ],
                'login' => true,
                'restricted' => true
            ],
            'admin/slides' => [
                'GET' => [
                    'controller' => $slideController,
                    'function' => 'listSlides',
                    'parameters' => []
                ],
                'login' => true,
                'restricted' => true
            ],
            'admin/access-restricted' => [
                'GET' => [
                    'controller' => $adminController,
                    'function' => 'accessRestricted',
                    'parameters' => []
                ],
                'login' => true
            ],
            // Error Pages
            '400' => [
                'GET' => [
                    'controller' => $siteController,
                    'function' => 'error400',
                    'parameters' => []
                ]
            ],
            '401' => [
                'GET' => [
                    'controller' => $siteController,
                    'function' => 'error401',
                    'parameters' => []
                ]
            ],
            '403' => [
                'GET' => [
                    'controller' => $siteController,
                    'function' => 'error403',
                    'parameters' => []
                ]
            ],
            '404' => [
                'GET' => [
                    'controller' => $siteController,
                    'function' => 'error404',
                    'parameters' => []
                ]
            ],
            '500' => [
                'GET' => [
                    'controller' => $siteController,
                    'function' => 'error500',
                    'parameters' => []
                ]
            ]
        ];

        return $routes;
    }

    // Function for passing variables to the site layout.
    public function getTemplateVariables() {
        return [
            'categories' => $this->categoriesTable->retrieveAllRecords()
        ];
    }

    // Function for checking whether a user is currently logged in.
	public function checkLogin() {
		if (!isset($_SESSION['isLoggedIn']))
			header('Location: /login');
    }

    // Function for checking whether a user has an appropriate level of access.
    public function checkAccess() {
        $this->updateRole();
        if (isset($_SESSION['isOwner']) || isset($_SESSION['isAdmin']))
            return true;
        else
            header('Location: /admin/access-restricted');
    }

    // Function for updating the user's role.
    public function updateRole() {
        // Check if the session variable $_SESSION['id'] has been set.
        if (isset($_SESSION['id'])) {
            require '../dbConnection.php';
            $user = $this->usersTable->retrieveRecord('user_id', $_SESSION['id'])[0];
    
            // Check the user's current role frm the database and update $_SESSION variables accordingly.
            if ($user->user_type == 2 && !isset($_SESSION['isOwner'])) {
                unset($_SESSION['isAdmin']);
                unset($_SESSION['isCustomer']);
                $_SESSION['isOwner'] = true;
            }
            else if ($user->user_type == 1 && !isset($_SESSION['isAdmin'])) {
                unset($_SESSION['isOwner']);
                unset($_SESSION['isCustomer']);
                $_SESSION['isAdmin'] = true;
            }
            elseif ($user->user_type == 0 && !isset($_SESSION['isCustomer'])) {
                unset($_SESSION['isOwner']);
                unset($_SESSION['isAdmin']);
                $_SESSION['isCustomer'] = true;
            }
        }
    }
}