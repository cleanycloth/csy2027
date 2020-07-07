<?php
namespace NNGames\Controllers;
class AdminController {
    // Function for displaying the admin home page.
    public function home() {
        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/home.html.php',
            'variables' => [],
            'title' => 'Admin Panel'
        ];
    }

    // Function for displaying the access restricted page.
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