<?php
require 'NNGames/Controllers/UserController.php';

class UserControllerTest extends \PHPUnit\Framework\TestCase {
    private $mockUsersTable;

    public function setUp() {
        $this->mockUsersTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
    }

    /* UserController Tests */
    // listUsers() Test
    function testListUsers() {
        // Declare mock user entities.
        $userEntity1 = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity2 = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity3 = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        
        // Setup value to be returned by retrieveAllRecords().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue([$userEntity1, $userEntity2, $userEntity3]));

        // Declare UserController instance and execute listUsers().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $result = $userController->listUsers();

        // Check if title and amount of categories are returned as expected.
        $this->assertEquals('Admin Panel - Users', $result['title']);
        $this->assertCount(3, $result['variables']['users']);
    }

    // loginForm() Tests
    function testLoginFormNotLoggedIn() {
        // Declare UserController instance and execute loginForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $result = $userController->loginForm();

        // Check if title is returned as expected.
        $this->assertEquals('Sign In', $result['title']);
    }

    function testLoginFormLoggedIn() {
        // Set $_SESSION variable.
        $_SESSION['isLoggedIn'] = true;

        // Declare UserController instance and execute loginForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $userController->loginForm();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /', xdebug_get_headers());
    }

    // registerForm() Tests
    function testRegisterFormNotLoggedIn() {
        // Unset $_SESSION variable.
        unset($_SESSION['isLoggedIn']);
        
        // Set $_SERVER variable.
        $_SERVER['REQUEST_URI'] = 'register';

        // Declare UserController instance and execute registerForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $result = $userController->registerForm();

        // Check if title is returned as expected.
        $this->assertEquals('Sign Up', $result['title']);
    }

    function testRegisterFormLoggedIn() {
        // Set $_SESSION variable.
        $_SESSION['isLoggedIn'] = true;

        // Set $_SERVER variable.
        $_SERVER['REQUEST_URI'] = 'myaccount';
    
        // Declare UserController instance and execute registerForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $userController->registerForm();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /', xdebug_get_headers());
    }

    // loginSubmit() Tests
    function testLoginSubmitNoDetails() {
        // Define POST data.
        $testPostData = [
            'login' => [
                'username' => '',
                'password' => ''
            ],
            'submit' => true
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['login']['username']))
            ->will($this->returnValue(null));
    
        // Declare UserController instance and execute loginSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->loginSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('You have not provided a username and/or password.', $result['variables']['error']);
    }

    function testLoginSubmitUserDoesNotExist() {
        // Define POST data.
        $testPostData = [
            'login' => [
                'username' => 'testinguser',
                'password' => 'password'
            ],
            'submit' => true
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['login']['username']))
            ->will($this->returnValue(null));

        // Declare UserController instance and execute loginSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->loginSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('A user with the username provided does not exist.', $result['variables']['error']);
    }

    function testLoginSubmitInvalidPassword() {
        // Define POST data.
        $testPostData = [
            'login' => [
                'username' => 'testinguser',
                'password' => 'password'
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->username = 'testinguser';
        $userEntity->password = 'wordpass';

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['login']['username']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute loginSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->loginSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The password provided is incorrect.', $result['variables']['error']);
    }

    function testLoginSubmitNotActivated() {
        // Define POST data.
        $testPostData = [
            'login' => [
                'username' => 'testinguser',
                'password' => 'password'
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->username = 'testinguser';
        $userEntity->password = '$2y$10$L5ET/sQ1hDZJGj2OkL7.0.UWX3EAJVcWYdsowh4rVadZEFTYqpjLu';
        $userEntity->activated = 0;

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['login']['username']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute loginSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->loginSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('Your account has not been activated. Please contact an administrator.', $result['variables']['error']);
    }

    function testLoginSubmitOwner() {
        // Define POST data.
        $testPostData = [
            'login' => [
                'username' => 'testinguser',
                'password' => 'password'
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->user_id = 1;
        $userEntity->username = 'testinguser';
        $userEntity->password = '$2y$10$L5ET/sQ1hDZJGj2OkL7.0.UWX3EAJVcWYdsowh4rVadZEFTYqpjLu';
        $userEntity->user_type = 2;
        $userEntity->activated = 1;

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['login']['username']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute loginSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $userController->loginSubmit();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /', xdebug_get_headers());

        // Unset session variable.
        unset($_SESSION['isOwner']);
    }

    function testLoginSubmitAdmin() {
        // Define POST data.
        $testPostData = [
            'login' => [
                'username' => 'testinguser',
                'password' => 'password'
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->user_id = 1;
        $userEntity->username = 'testinguser';
        $userEntity->password = '$2y$10$L5ET/sQ1hDZJGj2OkL7.0.UWX3EAJVcWYdsowh4rVadZEFTYqpjLu';
        $userEntity->user_type = 1;
        $userEntity->activated = 1;

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['login']['username']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute loginSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $userController->loginSubmit();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /', xdebug_get_headers());

        // Unset session variable.
        unset($_SESSION['isAdmin']);
    }

    function testLoginSubmitCustomer() {
        // Define POST data.
        $testPostData = [
            'login' => [
                'username' => 'testinguser',
                'password' => 'password'
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->user_id = 1;
        $userEntity->username = 'testinguser';
        $userEntity->password = '$2y$10$L5ET/sQ1hDZJGj2OkL7.0.UWX3EAJVcWYdsowh4rVadZEFTYqpjLu';
        $userEntity->user_type = 0;
        $userEntity->activated = 1;

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['login']['username']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute loginSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $userController->loginSubmit();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /', xdebug_get_headers());

        // Unset session variable.
        unset($_SESSION['isCustomer']);
    }

    // editUserForm() Tests
    function testEditUserFormNoId() {
        // Declare UserController instance and execute editUserForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $result = $userController->editUserForm();

        // Check
        $this->assertEquals('Add User', $result['variables']['pageName']);
    }

    function testEditUserFormWithIdNoUser() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue(null));

        // Declare UserController instance and execute editUserForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, $testGetData, null, null);
        $result = $userController->editUserForm();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/users', xdebug_get_headers());
    }

    function testEditUserFormWithIdNoPermission() {
        // Define $_SESSION variable.
        $_SESSION['id'] = 2;
        
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute editUserForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, $testGetData, null, null);
        $result = $userController->editUserForm();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/users', xdebug_get_headers());
    }

    function testEditUserFormWithIdOwner() {
        // Define $_SESSION variable.
        $_SESSION['isOwner'] = true;

        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute editUserForm().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, $testGetData, null, null);
        $result = $userController->editUserForm();

        // Check if pageName is returned as expected.
        $this->assertEquals('Edit User', $result['variables']['pageName']);
    }

    // editUserSubmit() Tests
    function testEditUserSubmitRegister() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'register';

        // Define POST data.
        $testPostData = [
            'user' => true,
            'submit' => true
        ];

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Sign Up', $result['variables']['pageName']);
    }

    function testEditUserSubmitNoId() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'admin/users/edit';

        // Define POST data.
        $testPostData = [
            'user' => true,
            'submit' => true
        ];

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Add User', $result['variables']['pageName']);
    }

    function testEditUserSubmitWithIdNoUser() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'admin/users/edit';

        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Define POST data.
        $testPostData = [
            'user' => true,
            'submit' => true
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue(null));

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, $testGetData, $testPostData, null);
        $result = $userController->editUserSubmit();

       // Check if header is set/returned as expected.
       $this->assertContains('Location: /admin/users', xdebug_get_headers());
    }

    function testEditUserSubmitBlankDetails() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'admin/users/edit';

        // Define POST data.
        $testPostData = [
            'user' => [
                'id' => '',
                'username' => '',
                'firstname' => '',
                'surname' => '',
                'email' => '',
                'password' => ''
            ],
            'submit' => true
        ];

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('The username cannot be blank.', $result['variables']['error']);
    }

    function testEditUserSubmitExistingUsername() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'admin/users/edit';

        // Define POST data.
        $testPostData = [
            'user' => [
                'id' => '',
                'username' => 'testinguser',
                'firstname' => '',
                'surname' => '',
                'email' => '',
                'password' => '',
                'confirm-password' => ''
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->username = 'testinguser';

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['user']['username']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('The specified username is already in use.', $result['variables']['error']);
    }

    function testEditUserSubmitAllDetailsAdmin() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'admin/users/edit';

        // Define POST data.
        $testPostData = [
            'user' => [
                'id' => '',
                'username' => 'testinguser',
                'firstname' => 'Testing',
                'surname' => 'User',
                'email' => 'testing@user.com',
                'password' => 'password',
                'confirm-password' => 'password'
            ],
            'submit' => true
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->at(0))
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['user']['username']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(1))
            ->method('retrieveRecord')
            ->with($this->equalTo('email'), $this->equalTo($testPostData['user']['email']))
            ->will($this->returnValue(null));

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('User Created', $result['variables']['pageName']);
    }

    function testEditUserSubmitAllDetailsAdminWithId() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'admin/users/edit';

        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Define POST data.
        $testPostData = [
            'user' => [
                'id' => '1',
                'username' => 'testinguser',
                'firstname' => 'Testing',
                'surname' => 'User',
                'email' => 'testing@user.com',
                'password' => 'password',
                'confirm-password' => 'password'
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->username = 'testinguser';
        $userEntity->email = 'testing@user.com';

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->at(0))
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(1))
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['user']['username']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(2))
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$userEntity]));

        $this->mockUsersTable->expects($this->at(3))
            ->method('retrieveRecord')
            ->with($this->equalTo('email'), $this->equalTo($testPostData['user']['email']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(4))
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, $testGetData , $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('User Created', $result['variables']['pageName']);
    }    

    function testEditUserSubmitAllDetailsAdminWithIdNoPassword() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'admin/users/edit';

        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Define POST data.
        $testPostData = [
            'user' => [
                'id' => '1',
                'username' => 'testinguser',
                'firstname' => 'Testing',
                'surname' => 'User',
                'email' => 'testing@user.com',
                'password' => '',
                'confirm-password' => ''
            ],
            'submit' => true
        ];

        // Declare mock user entity.
        $userEntity = $this->getMockBuilder('\NNGames\Entities\User')->disableOriginalConstructor()->getMock();
        $userEntity->username = 'testinguser';
        $userEntity->email = 'testing@user.com';

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->at(0))
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(1))
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['user']['username']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(2))
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$userEntity]));

        $this->mockUsersTable->expects($this->at(3))
            ->method('retrieveRecord')
            ->with($this->equalTo('email'), $this->equalTo($testPostData['user']['email']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(4))
            ->method('retrieveRecord')
            ->with($this->equalTo('user_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$userEntity]));

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, $testGetData , $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('User Created', $result['variables']['pageName']);
    }    

    function testEditUserSubmitAllDetailsRegister() {
        // Define REQUEST URI variable.
        $_SERVER['REQUEST_URI'] = 'register';

        // Define POST data.
        $testPostData = [
            'user' => [
                'id' => '',
                'username' => 'testinguser',
                'firstname' => 'Testing',
                'surname' => 'User',
                'email' => 'testing@user.com',
                'password' => 'password',
                'confirm-password' => 'password',
                'tos-privacy-agreement' => 1
            ],
            'submit' => true
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->at(0))
            ->method('retrieveRecord')
            ->with($this->equalTo('username'), $this->equalTo($testPostData['user']['username']))
            ->will($this->returnValue(null));

        $this->mockUsersTable->expects($this->at(1))
            ->method('retrieveRecord')
            ->with($this->equalTo('email'), $this->equalTo($testPostData['user']['email']))
            ->will($this->returnValue(null));

        // Declare UserController instance and execute editUserSubmit().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $result = $userController->editUserSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Account Created', $result['variables']['pageName']);
    }

    // deleteUser() Test
    function testDeleteUser() {
        // Define POST data.
        $testPostData = [
            'user' => [
                'user_id' => 1
            ]
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockUsersTable->expects($this->once())
            ->method('deleteRecordById')
            ->with($this->equalTo($testPostData['user']['user_id']));

        // Declare UserController instance and execute deleteUser().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, $testPostData, null);
        $userController->deleteUser();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/users', xdebug_get_headers());
    }

    // logout() Tests
    function testLogoutNotLoggedIn() {
        // Unset $_SESSION variable.
        unset($_SESSION['isLoggedIn']);

        // Declare UserController instance and execute logout().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $userController->logout();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /login', xdebug_get_headers());
    }

    function testLogoutLoggedIn() {
        // Set $_SESSION variable.
        $_SESSION['isLoggedIn'] = true;

        // Declare UserController instance and execute logout().
        $userController = new \NNGames\Controllers\UserController($this->mockUsersTable, null, null, null);
        $result = $userController->logout();

        // Check if title is returned as expected.
        $this->assertEquals('Log out', $result['title']);
    }
}
?>