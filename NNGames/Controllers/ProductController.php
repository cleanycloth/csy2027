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

    // Method for displaying the page for an individual product.
    public function product() {
        return [ 
            'layout' => 'layout.html.php',
            'template' => 'product.html.php',
            'variables' => [],
            'title' => 'Product'
        ];
    }

    // Method for listing out multiple products from the database.
    public function listProducts() {
        // Retrieve all products, platforms and genres.
        $products = $this->productsTable->retrieveAllRecords();
        $platforms = $this->platformsTable->retrieveAllRecords();
        $genres = $this->genresTable->retrieveAllRecords();

        $filteredProducts = null;
        // Filter products by search term(s).
        if (isset($this->get['search']) && $this->get['search'] != '') {
            $searchTerms = explode(" ", $this->get['search']);
            foreach ($products as $product) {
                for ($i=0; $i<count($searchTerms); $i++) {
                    if (strcasecmp($product->name, $this->get['search']) == 0 || stripos($product->name, $searchTerms[$i]) !== false) {
                        $searchFilteredProducts[] = $product;
                        break;
                    }
                }

                if (isset($searchFilteredProducts)) {
                    $filteredProducts = $searchFilteredProducts;
                    $errorMsg = '';
                }
                else
                    $errorMsg = 'No products match the specified search terms.';

                $pageName = 'Search Results';
            }
        }

        // Filter products by selected category.
        if (isset($this->get['category']) && $this->get['category'] != '') {
            if (isset($this->categoriesTable->retrieveRecord('name', urldecode($this->get['category']))[0]))
                $category = $this->categoriesTable->retrieveRecord('name', urldecode($this->get['category']))[0];

            if (!empty($category)) {
                foreach ($products as $product) {
                    if ($product->category_id == $category->category_id)
                        $categoryFilteredProducts[] = $product;
                }
        
                $pageName = $category->name;

                if (isset($categoryFilteredProducts)) {
                    $filteredProducts = $categoryFilteredProducts;
                    $errorMsg = '';
                }
                else 
                    $errorMsg = 'This category currently has no products.';
            }
            else {
                $filteredProducts = null;
                $pageName = 'Category Does Not Exist';
                $errorMsg = 'The specified category does not exist.';
            }
        }

        // Filter products by selected platform.
        if (isset($this->get['platform']) && $this->get['platform'] != '') {
            if (isset($this->platformsTable->retrieveRecord('name', urldecode($this->get['platform']))[0]))
                $platform = $this->platformsTable->retrieveRecord('name', urldecode($this->get['platform']))[0];

            if (!empty($filteredProducts) && !empty($platform)) {
                foreach ($filteredProducts as $product) {
                    if ($product->platform_id == $platform->platform_id) {
                        $platformFilteredProducts[] = $product;
                    }
                }

                if (isset($platformFilteredProducts))
                    $filteredProducts = $platformFilteredProducts;
                else
                    $filteredProducts = null;
            }
            else if (empty($filteredProducts) && !empty($platform)) {
                foreach ($products as $product) {
                    if ($product->platform_id == $platform->platform_id) {
                        $platformFilteredProducts[] = $product;
                    }
                }

                if (isset($platformFilteredProducts))
                    $filteredProducts = $platformFilteredProducts;
                else
                    $filteredProducts = null;

                if (!isset($pageName) && !isset($errorMsg) && !empty($filteredProducts)) {
                    $pageName = $platform->name;
                    $errorMsg = '';   
                }
                else {
                    $pageName = $platform->name;
                    $errorMsg = 'There are currently no products that match the selected filters.';
                }
            }
            else {
                $filteredProducts = null;
                $pageName = 'Platform Does Not Exist';
                $errorMsg = 'The specified platform does not exist.';
            }
        }

        // Filter products by selected genre.
        if (isset($this->get['genre']) && $this->get['genre'] != '') {
            if (isset($this->genresTable->retrieveRecord('name', urldecode($this->get['genre']))[0]))
                $genre = $this->genresTable->retrieveRecord('name', urldecode($this->get['genre']))[0];

            if (!empty($filteredProducts) && !empty($genre)) {
                foreach ($filteredProducts as $product) {
                    if ($product->genre_id == $genre->genre_id) {
                        $genreFilteredProducts[] = $product;
                    }
                }

                if (isset($genreFilteredProducts))
                    $filteredProducts = $genreFilteredProducts;
                else
                    $filteredProducts = null;
            }
            else if (empty($filteredProducts) && !empty($genre)) {
                foreach ($products as $product) {
                    if ($product->genre_id == $genre->genre_id) {
                        $genreFilteredProducts[] = $product;
                    }
                }
                
                if (isset($genreFilteredProducts))
                    $filteredProducts = $genreFilteredProducts;
                else
                    $filteredProducts = null;

                if (!isset($pageName) && !isset($errorMsg) && !empty($filteredProducts)) {
                    $pageName = $genre->name;
                    $errorMsg = '';   
                }
                else {
                    $pageName = $genre->name;
                    $errorMsg = 'There are currently no products that match the selected filters.';
                }
            }
            else {
                $filteredProducts = null;
                $pageName = 'Genre Does Not Exist';
                $errorMsg = 'The specified genre does not exist.';
            }
        }

        // Display only X amount of products  according to page number
        $productsPerPage = 9;

        if (isset($this->get['page']) && $this->get['page'] != '')
            $pageNumber = $this->get['page'];
        else 
            $pageNumber = 1;

        if ($pageNumber > 0)
            $offset = ($pageNumber-1) * $productsPerPage;
        else
            header('Location: ' . (str_replace("page=$pageNumber", "page=1", $_SERVER['REQUEST_URI'])));

        if (!empty($filteredProducts)) {
            for ($i=$offset; $i<$offset+$productsPerPage && $i<count($filteredProducts); $i++) {
                $paginatedFilteredProducts[] = $filteredProducts[$i];
            }

            $totalProducts = count($filteredProducts);
            $totalPages = ceil(count($filteredProducts) / $productsPerPage);
        }
        else {
            for ($i=$offset; $i<$offset+$productsPerPage && $i<count($products); $i++) {
                $paginatedFilteredProducts[] = $products[$i];
            }

            $totalProducts = count($products);
            $totalPages = ceil(count($products) / $productsPerPage);
        }

        // Display all products if no $_GET variables are declared.
        if (!isset($this->get['search']) && !isset($this->get['category']) && !isset($this->get['platform']) && !isset($this->get['genre'])) {
            $pageName = 'All Products';

            if (count($products) > 0) { 
                if (isset($paginatedFilteredProducts)) {
                    $filteredProducts = $paginatedFilteredProducts;
                    $errorMsg = '';
                }
                else {
                    $previousPageNumber = $pageNumber-1;
                    header('Location: ' . (str_replace("page=$pageNumber", "page=$previousPageNumber", $_SERVER['REQUEST_URI'])));
                }
            }
            else 
                $errorMsg = 'There are currently no products.';
        }

        if (!empty($filteredProducts) > 0)
            $upperAmount = $offset+count($filteredProducts);
        else
            $upperAmount = 0;

        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/main/products.html.php',
            'variables' => [
                'pageName' => $pageName,
                'errorMsg' => $errorMsg,
                'lowerAmount' => $offset+1,
                'upperAmount' => $upperAmount,
                'totalProducts' => $totalProducts,
                'totalPages' => $totalPages,
                'products' => $filteredProducts,
                'platforms' => $platforms,
                'genres' => $genres
            ],
            'title' => 'Products'
        ];
    }

    public function listProductsAdmin() {
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
                    if (isset($this->get['id'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], ltrim($product->image, '/'));

                        $this->productsTable->save($this->post['product']);  
                    }
                    else {
                        $parts = explode('.', $_FILES['image']['name']);
                        $extension = end($parts);
                        $filePath = '/images/products/' . uniqid() . '.' . $extension;
                        move_uploaded_file($_FILES['image']['tmp_name'], ltrim($filePath, '/'));

                        $this->post['product']['image'] = $filePath;
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

    // Method for deleting a product from the database and its image.
    public function deleteProduct() {
        $image = $this->productsTable->retrieveRecord('product_id', $this->post['product']['product_id'])[0]->image;

        $this->productsTable->deleteRecordById($this->post['product']['product_id']);

        if ($image != '/images/image-placeholder.jpg')
            unlink(ltrim($image, '/'));

        header('Location: /admin/products');
    }
}
?>