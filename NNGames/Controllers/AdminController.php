<?php
namespace NNGames\Controllers;
class AdminController {
    // Function for displaying the admin home page.
    public function home() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/admin/home.html.php',
            'variables' => [],
            'title' => 'Admin Panel'
        ];
    }

    public function users() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/admin/users.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Users'
        ];
    }

    public function products() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/admin/products.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Products'
        ];
    }

    public function categories() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/admin/categories.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Categories'
        ];
    }

    public function slides() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/admin/slides.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Slides'
        ];
    }

    public function accessRestricted() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/admin/restricted.html.php',
            'variables' => [],
            'title' => 'Admin Panel - Access Restricted'
        ];
    }
}
?>