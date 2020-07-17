<?php
namespace NNGames\Controllers;
class AccountController {
    public function mainView() {
        return [
            'layout' => 'accountlayout.html.php',
            'template' => 'pages/account/account.html.php',
            'variables' => [],
            'title' => 'My Account'
        ];
    }

    public function addresses() {
        return [
            'layout' => 'accountlayout.html.php',
            'template' => 'pages/account/addresses.html.php',
            'variables' => [],
            'title' => 'My Account - Addresses'
        ];
    
    }

    public function payment () {
        return [
            'layout' => 'accountlayout.html.php',
            'template' => 'pages/account/payinfo.html.php',
            'variables' => [],
            'title' => 'My Account - Payment Info'
        ];
    }

    public function orders () {
        return [
            'layout' => 'accountlayout.html.php',
            'template' => 'pages/account/orders.html.php',
            'variables' => [],
            'title' => 'My Account - Order History'
        ];
    }

    public function settings () {
        return [
            'layout' => 'accountlayout.html.php',
            'template' => 'pages/account/settings.html.php',
            'variables' => [],
            'title' => 'My Account - Account Settings'
        ];
    }
}
?>