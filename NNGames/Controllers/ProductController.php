<?php
namespace NNGames\Controllers;
class ProductController {
    private $productsTable;
    private $categoriesTable;
    private $platformsTable;
    private $genresTable;
    private $get;
    private $post;
    private $files;

    public function __construct(\CSY2028\DatabaseTable $productsTable, \CSY2028\DatabaseTable $categoriesTable, 
                                \CSY2028\DatabaseTable $platformsTable, \CSY2028\DatabaseTable $genresTable, $get, $post, $files) {
        $this->productsTable = $productsTable;
        $this->categoriesTable = $categoriesTable;
        $this->platformsTable = $platformsTable;
        $this->genresTable = $genresTable;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
    }

    // Method for displaying the page for an individual product.
    public function viewProduct() {
        if (isset($this->get['id'])) {
            $product = $this->productsTable->retrieveRecord('product_id', $this->get['id'])[0];

            if (empty($product))
                header('Location: /products');
            else {
                $category = $this->categoriesTable->retrieveRecord('category_id', $product->category_id);
                $platform = $this->platformsTable->retrieveRecord('platform_id', $product->platform_id);
                $genre = $this->genresTable->retrieveRecord('genre_id', $product->genre_id);
            
                if (!empty($category))
                    $categoryName = $category[0]->name;
                else
                    $categoryName = 'N/A';

                if (!empty($platform))
                    $platformName = $platform[0]->name;
                else
                    $platformName = 'N/A';

                if (!empty($genre))
                    $genreName = $genre[0]->name;
                else
                    $genreName = 'N/A';

                return [ 
                    'layout' => 'layout.html.php',
                    'template' => 'product.html.php',
                    'variables' => [
                        'product' => $product,
                        'categoryName' => $categoryName,
                        'platformName' => $platformName,
                        'genreName' => $genreName
                    ],
                    'title' => 'Product - ' . $product->name
                ];
            }
        }
        else
            header('Location: /products');
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
            $product = $this->productsTable->retrieveRecord('name', $this->get['search']);

            if (!empty($product)) {
                $searchFilteredProducts[] = $product[0]; 
            }
            else {
                $searchTerms = explode(" ", $this->get['search']);            
                foreach ($products as $product) {
                    for ($i=0; $i<count($searchTerms); $i++) {
                        if (strcasecmp($product->name, $this->get['search']) == 0 || stripos($product->name, $searchTerms[$i]) !== false) {
                            $searchFilteredProducts[] = $product;
                            break;
                        }
                    }
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
        else {
            $pageName = 'Search Results';
            $errorMsg = 'You have not entered any search terms.';
        }

        // Filter products by selected category.
        if (isset($this->get['category']) && $this->get['category'] != '') {
            $category = $this->categoriesTable->retrieveRecord('name', urldecode($this->get['category']));

            if (!empty($category)) {
                $childCategories = $category[0]->getChildCategories();
                foreach ($products as $product) {
                    if ($product->category_id == $category[0]->category_id)
                        $categoryFilteredProducts[] = $product;
                    else {
                        foreach ($childCategories as $childCategory) {
                            if ($product->category_id == $childCategory->category_id) {
                                $categoryFilteredProducts[] = $product;
                            }
                        }
                    }
                }
        
                $pageName = $category[0]->name;

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
            'title' => 'Products - ' . $pageName
        ];
    }

    // Method for listing out products in the admin panel.
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

    // Method for returning product search results in JSON format.
    public function returnSearchResults() {
        $products = $this->productsTable->retrieveAllRecords();

        if (isset($this->get['search']) && $this->get['search'] != '') {
            // Split up search terms into array.
            $searchTerms = explode(' ', $this->get['search']);

            // Declare blank $searchResults['result'] array.
            $searchResults['results'] = null;

            // Loop through each of the products in the database.
            foreach ($products as $product) {
                // Declare blank string for RegEx pattern.
                $regExString = '';

                // Loop through the $searchTerms array to compare product names against each term.
                for ($i=0; $i<count($searchTerms); $i++) {
                    // Add search terms to the variable $regExString to build a RegEx pattern.
                    for ($j=0; $j<count($searchTerms); $j++) {
                        $searchTermNoSpecialChars = preg_replace('/[^A-Za-z0-9\-]/', '', $searchTerms[$j]);
                        $regExString .= $searchTermNoSpecialChars . '|';
                    }

                    // Remove spaces (replaced with hyphens) and other special characters from product name.
                    $productNameNoSpaces = str_replace(' ', '-', $product->name);
                    $productNameNoSpecialChars = preg_replace('/[^A-Za-z0-9\-]/', '', $productNameNoSpaces);
                    
                    // Remove spaces (replaced with hyphens) and other special characters from search string.
                    $searchStringNoSpaces = str_replace(' ', '-', $this->get['search']);
                    $searchStringNoSpecialChars = preg_replace('/[^A-Za-z0-9\-]/', '', $searchStringNoSpaces);

                    // Add search result to $searchResults['results'] array if the search string is inside the product name string.
                    if (stripos($productNameNoSpecialChars, $searchStringNoSpecialChars) !== false) {
                        $trimmedRegExString = rtrim($regExString, '|');
                        $boldedName = preg_replace("/($trimmedRegExString)/i", '<b>$0</b>', $product->name);
                        $searchResults['results'][] = $boldedName;
                        break;
                    }

                    // Source: https://stackoverflow.com/questions/16733674/php-remove-symbols-from-string
                    // Source: https://stackoverflow.com/questions/22730461/make-bold-specific-part-of-string
                }
            }
        }
        else {
            $searchResults['results'] = null;
        }

        return [
            'layout' => 'blanklayout.html.php',
            'template' => 'json/response.html.php',
            'variables' => [
                'response' => json_encode($searchResults)
            ],
            'title' => 'JSON Response'
        ];
    }

    // Method for displaying the edit product form.
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

            $uploadedFile = $this->files['image']['tmp_name'];

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

                if ($this->files['image']['tmp_name'] != '') {
                    if (isset($this->get['id'])) {
                        move_uploaded_file($this->files['image']['tmp_name'], ltrim($product->image, '/'));

                        $this->productsTable->save($this->post['product']);  
                    }
                    else {
                        $parts = explode('.', $this->files['image']['name']);
                        $extension = end($parts);
                        $filePath = '/images/products/' . uniqid() . '.' . $extension;
                        move_uploaded_file($this->files['image']['tmp_name'], ltrim($filePath, '/'));

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