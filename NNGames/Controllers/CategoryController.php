<?php
namespace NNGames\Controllers;
class CategoryController {
    private $categoriesTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $categoriesTable, $get, $post) {
        $this->categoriesTable = $categoriesTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function listCategories() {
        $categories = $this->categoriesTable->retrieveAllRecords();

        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/categories.html.php',
            'variables' => [
                'categories' => $categories,
            ],
            'title' => 'Admin Panel - Categories'
        ];
    }
}
?>