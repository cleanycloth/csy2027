<?php
namespace NNGames\Controllers;
class AdminController {
    // Function for displaying the admin home page.
    public function home() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'admin/home.html.php',
            'variables' => [],
            'title' => 'NNGames - Admin Panel'
        ];
    }

    public function accessRestricted() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'admin/restricted.html.php',
            'variables' => [],
            'title' => 'NNGames - Admin Panel - Access Restricted'
        ];
    }
}
?>