<?php
namespace NNGames\Controllers;
class ProductController {
    private $productsTable;
    private $categoriesTable;
    private $platformsTable;
    private $genresTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $productsTable, \CSY2028\DatabaseTable $categoriesTable, \CSY2028\DatabaseTable $platformsTable, \CSY2028\DatabaseTable $genresTable, $get, $post) {
        $this->productsTable = $productsTable;
        $this->categoriesTable = $categoriesTable;
        $this->platformsTable = $platformsTable;
        $this->genresTable = $genresTable;
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

    public function editProductForm() {
        $categories = $this->categoriesTable->retrieveAllRecords();
        $platforms = $this->platformsTable->retrieveAllRecords();
        $genres = $this->genresTable->retrieveAllRecords();

        if (!isset($this->get['id']))
            $pageName = 'Add Product';
        else
            $pageName = 'Edit Product';

        // Check if $_GET['id'] has been set. If so, display
        // a pre-filled edit category (Edit Product) form.
        if (isset($this->get['id'])) {
            $product = $this->productsTable->retrieveRecord('product_id', $this->get['id'])[0];

            if (empty($product))
                header('Location: /admin/products');

            return [
                'layout' => 'adminlayout.html.php',
                'template' => 'pages/admin/editproduct.html.php',
                'variables' => [
                    'product' => $product,
                    'categories' => $categories,
                    'platforms' => $platforms,
                    'genres' => $genres,
                    'pageName' => $pageName
                ],
                'title' => 'Admin Panel - ' . $pageName
            ];   
        }
        else {
            return [
                'layout' => 'adminlayout.html.php',
                'template' => 'pages/admin/editproduct.html.php',
                'variables' => [
                    'categories' => $categories,
                    'platforms' => $platforms,
                    'genres' => $genres,
                    'pageName' => $pageName
                ],
                'title' => 'Admin Panel - ' . $pageName
            ];        
        }       
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