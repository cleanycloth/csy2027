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