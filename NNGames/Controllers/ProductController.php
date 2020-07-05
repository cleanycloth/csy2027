<?php
namespace NNGames\Controllers;
class ProductController {
    private $productsTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $productsTable, $get, $post) {
        $this->productsTable = $productsTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function listProducts() {
        $products = $this->productsTable->retrieveAllRecords();

        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/products.html.php',
            'variables' => [
                'products' => $products
            ],
            'title' => 'Admin Panel - Products'
        ];
    }

    // Method for displaying the page for an individual product.
    public function product() {
        return [ 
            'layout' => 'layout.html.php',
            'template' => 'product.html.php',
            'variables' => [],
            'title' => 'Product'
        ];
    }
}
?>