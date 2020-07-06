<?php
namespace NNGames\Controllers;
class ProductController {
    private $productsTable;
    private $imagesTable;
    private $categoriesTable;
    private $platformsTable;
    private $genresTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $productsTable, \CSY2028\DatabaseTable $imagesTable, \CSY2028\DatabaseTable $categoriesTable, 
                                \CSY2028\DatabaseTable $platformsTable, \CSY2028\DatabaseTable $genresTable, $get, $post) {
        $this->productsTable = $productsTable;
        $this->imagesTable = $imagesTable;
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

    // Method for adding/updating a product in the database.
    public function editProductSubmit() {
        $categories = $this->categoriesTable->retrieveAllRecords();
        $platforms = $this->platformsTable->retrieveAllRecords();
        $genres = $this->genresTable->retrieveAllRecords();

        if (isset($this->post['product'])) {
            if (isset($this->get['id'])) {
                $product = $this->productsTable->retrieveRecord('product_id', $this->get['id'])[0];

                if (empty($product))
                    header('Location: /admin/products');
            }
            else
                $product = '';

            $uploadedFile = $_FILES['image']['tmp_name'];

            if ($uploadedFile == '') {
                if ($this->post['product']['name'] != '') {
                    if ($this->post['product']['price'] != '') {
                        if (is_numeric($this->post['product']['price'])) {
                            if ($this->post['product']['description'] == '')
                                $error = 'The description cannot be blank.';
                        }
                        else
                            $error = 'The price must be a number.';
                    }
                    else
                        $error = 'The price cannot be blank.';
                }
                else
                    $error = 'The product name cannot be blank.';
            }
            else {
                if (mime_content_type($uploadedFile) == 'image/jpeg') {
                    if (getimagesize($uploadedFile)[0] == 400 && getimagesize($uploadedFile)[1] == 400) {
                        if ($this->post['product']['name'] != '') {
                            if ($this->post['product']['price'] != '') {
                                if (is_numeric($this->post['product']['price'])) {
                                    if ($this->post['product']['description'] == '')
                                        $error = 'The description cannot be blank.';
                                }
                                else
                                    $error = 'The price must be a number.';
                            }
                            else
                                $error = 'The price cannot be blank.';
                        }
                        else
                            $error = 'The product name cannot be blank.';
                    }
                    else
                        $error = 'The image needs to have dimensions of 400x400.';
                }
                else
                    $error = 'The file uploaded is not a JPEG image.';
            }

            if (!isset($error)) {
                if (isset($this->get['id'])) {
                    $pageName = 'Product Updated';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/success/editproductsuccess.html.php';
                }
                else {
                    $pageName = 'Product Added';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/success/editproductsuccess.html.php';
                }

                if ($this->post['product']['category_id'] == '')
                    unset($this->post['product']['category_id']);

                if ($this->post['product']['platform_id'] == '')
                    unset($this->post['product']['platform_id']);

                if ($this->post['product']['genre_id'] == '')
                    unset($this->post['product']['genre_id']);

                if ($_FILES['image']['tmp_name'] != '') {
                    $imageId = $this->productsTable->retrieveRecord('product_id', $this->get['id'])[0]->image_id;
                    if (!empty($imageId))
                        $this->imagesTable->saveBlob($imageId, $_FILES['image']['tmp_name'], $_FILES['image']['type']);
                    else {
                        $this->imagesTable->saveBlob(null, $_FILES['image']['tmp_name'], $_FILES['image']['type']);
                        $this->post['product']['image_id'] = $this->imagesTable->lastInsertId();
                        $this->productsTable->save($this->post['product']);
                    }
                }
                else
                    $this->productsTable->save($this->post['product']);

                $variables = [
                    'pageName' => $pageName,
                    'productName' => htmlspecialchars(strip_tags($this->post['product']['name']), ENT_QUOTES, 'UTF-8')
                ];
            }
            else {
                if (isset($this->get['id'])) {
                    $pageName = 'Edit Product';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/editproduct.html.php';
                }
                else {
                    $pageName = 'Add Product';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/editproduct.html.php';
                }
                
                $variables = [
                    'pageName' => $pageName,
                    'error' => $error,
                    'categories' => $categories,
                    'platforms' => $platforms,
                    'genres' => $genres,
                    'product' => $product
                ];
            }
        }

        return [
            'layout' => $layout,
            'template' => $template,
            'variables' => $variables,
            'title' => 'Admin Panel - ' . $pageName
        ];
    }

    // Method for deleting a product from the database.
    public function deleteProduct() {
        $imageId = $this->productsTable->retrieveRecord('product_id', $this->post['product']['product_id'])[0]->image_id;

        $this->productsTable->deleteRecordById($this->post['product']['product_id']);

        if (!empty($imageId))
            $this->imagesTable->deleteRecordById($imageId);

        header('Location: /admin/products');
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