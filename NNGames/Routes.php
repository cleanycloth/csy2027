<?php
namespace NNGames;
class Routes implements \CSY2028\Routes {
    private $usersTable;
    private $categoriesTable;

    public function getRoutes() {
        require '../dbConnection.php';

        // Create new DatabaseTable objects.
        $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'category_id');
        $this->usersTable = new \CSY2028\DatabaseTable($pdo, 'users', 'user_id', '\NNGames\Entities\User');
        $addressesTable = new \CSY2028\DatabaseTable($pdo, 'addresses', 'address_id');
        $productsTable = new \CSY2028\DatabaseTable($pdo, 'products', 'product_id');
        $productReviewsTable = new \CSY2028\DatabaseTable($pdo, 'product_reviews', 'product_id');
        $platformsTable = new \CSY2028\DatabaseTable($pdo, 'platforms', 'platform_id');
        $genresTable = new \CSY2028\DatabaseTable($pdo, 'genres', 'genre_id');
        $ordersTable = new \CSY2028\DatabaseTable($pdo, 'orders', 'order_id');
        $orderDetailsTable = new \CSY2028\DatabaseTable($pdo, 'order_details', 'order_id');
        $paymentsTable = new \CSY2028\DatabaseTable($pdo, 'payments', 'payment_id');

        // Create new controller objects.
        $siteController = new \NNGames\Controllers\SiteController();
        $userController = new \NNGames\Controllers\UserController($this->usersTable, $_GET, $_POST);
        $productController = new \NNGames\Controllers\ProductController($productsTable, $_GET, $_POST);

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
                    'function' => 'login',
                    'parameters' => []
                ]
            ],
            'register' => [
                'GET' => [
                    'controller' => $userController,
                    'function' => 'register',
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
            'test' => [
                'GET' => [
                    'controller' => $siteController,
                    'function' => 'testResponse',
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
		session_start();
		if (!isset($_SESSION['isLoggedIn']))
			header('Location: /admin/login');
    }

    // Function for checking whether a user has an appropriate level of access.
    public function checkAccess() {
        $this->updateRole();
        if (isset($_SESSION['isAdmin']))
            return true;
        else
            header('Location: /admin/access-restricted');
    }

    // Function for updating the user's role.
    public function updateRole() {
        // Check if the session variable $_SESSION['id'] has been set.
        if (isset($_SESSION['id'])) {
            require '../dbConnection.php';
            $user = $usersTable->retrieveRecord('user_id', $_SESSION['id'])[0];
    
            // Check the user's current role frm the database and update $_SESSION variables accordingly.
            if ($user->role == 1 && !isset($_SESSION['isAdmin'])) {
                unset($_SESSION['isCustomer']);
                $_SESSION['isAdmin'] = true;
            }
            elseif ($user->role == 0 && !isset($_SESSION['isCustomer'])) {
                unset($_SESSION['isAdmin']);
                $_SESSION['isCustomer'] = true;
            }
        }
    }
}