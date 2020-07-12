<?php
require 'NNGames/Controllers/ProductController.php';

class ProductControllerTest extends \PHPUnit\Framework\TestCase {
    private $mockProductsTable;
    private $mockCategoriesTable;
    private $mockPlatformsTable;
    private $mockGenresTable;

    public function setUp() {
        // Create mock database tables.
        $this->mockProductsTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
        $this->mockCategoriesTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
        $this->mockPlatformsTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
        $this->mockGenresTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
    }

    /* ProductController Tests */
    // viewProduct() Tests
    function testViewProductNoId() {
        // Declare ProductController instance and execute viewProduct().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, null, null);
        $productController->viewProduct();
    
        // Check if header is set/returned as expected.
        $this->assertContains('Location: /products', xdebug_get_headers());
    }

    function testViewProductWithIdNoProduct() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Declare ProductController instance and execute viewProduct().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, null, null);
        $productController->viewProduct();
    
        // Check if header is set/returned as expected.
        $this->assertContains('Location: /products', xdebug_get_headers());
    }

    function testViewProductWithIdNoCategoryNoPlatformNoGenre() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Create product entity.
        $productEntity = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity->category_id = null;
        $productEntity->platform_id = null;
        $productEntity->genre_id = null;

        // Setup value to be returned by retrieveRecord().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('product_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$productEntity]));

        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('category_id'), $this->equalTo($productEntity->category_id))
            ->will($this->returnValue(null));

        $this->mockPlatformsTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('platform_id'), $this->equalTo($productEntity->platform_id))
            ->will($this->returnValue(null));

        $this->mockGenresTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('genre_id'), $this->equalTo($productEntity->genre_id))
            ->will($this->returnValue(null));

        // Declare ProductController instance and execute viewProduct().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, null, null);
        $result = $productController->viewProduct();
    
        // Check if names are equal to N/A.
        $this->assertEquals('N/A', $result['variables']['categoryName']);
        $this->assertEquals('N/A', $result['variables']['platformName']);
        $this->assertEquals('N/A', $result['variables']['genreName']);
    }

    function testViewProductWithIdWithCategoryPlatformGenre() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Create product entity.
        $productEntity = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity->category_id = 1;
        $productEntity->platform_id = 1;
        $productEntity->genre_id = 1;

        // Create category entity.
        $categoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity->category_id = 1;
        $categoryEntity->name = 'Test Category';

        // Create platform entity.
        $platformEntity = $this->getMockBuilder('\NNGames\Entities\Platform')->disableOriginalConstructor()->getMock();
        $platformEntity->platform_id = 1;
        $platformEntity->name = 'Test Platform';

        // Create genre entity.
        $genreEntity = $this->getMockBuilder('\NNGames\Entities\Genre')->disableOriginalConstructor()->getMock();
        $genreEntity->genre_id = 1;
        $genreEntity->name = 'Test Genre';

        // Setup value to be returned by retrieveRecord().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('product_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$productEntity]));

        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('category_id'), $this->equalTo($productEntity->category_id))
            ->will($this->returnValue([$categoryEntity]));

        $this->mockPlatformsTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('platform_id'), $this->equalTo($productEntity->platform_id))
            ->will($this->returnValue([$platformEntity]));

        $this->mockGenresTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('genre_id'), $this->equalTo($productEntity->genre_id))
            ->will($this->returnValue([$genreEntity]));

        // Declare ProductController instance and execute viewProduct().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, null, null);
        $result = $productController->viewProduct();
    
        // Check if names are equal to N/A.
        $this->assertEquals('Test Category', $result['variables']['categoryName']);
        $this->assertEquals('Test Platform', $result['variables']['platformName']);
        $this->assertEquals('Test Genre', $result['variables']['genreName']);
    }

    // listProductsAdmin() Test
    function testListProductsAdmin() {
        // Create product entities.
        $productEntity1 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity2 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity3 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();

        // Setup value to be returned by retrieveAllRecords().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue([$productEntity1, $productEntity2, $productEntity3]));

        // Declare ProductController instance and execute listProductsAdmin().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, null, null);
        $result = $productController->listProductsAdmin();

        // Check if product count is equal to 3.
        $this->assertCount(3, $result['variables']['products']);
    }

    // returnSearchResults() Tests
    function testReturnSearchResultsNoSearchTerms() {
        // Setup value to be returned by retrieveAllRecords().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));
        
        // Declare ProductController instance and execute returnSearchResults().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, null, null);
        $result = $productController->returnSearchResults();        

        // Check if response is null.
        $this->assertNull(json_decode($result['variables']['response'], true)['results']);
    }

    function testReturnSeachResultsWithSearchTerms() {
        // Define GET data.
        $testGetData = [
            'search' => 'Test Product'
        ];

        // Create product entities.
        $productEntity1 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity1->name = 'Test Product One';

        $productEntity2 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity2->name = 'Test Product Two';

        $productEntity3 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity3->name = 'New Item Three';

        // Setup value to be returned by retrieveAllRecords().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue([$productEntity1, $productEntity2, $productEntity3]));

        // Declare ProductController instance and execute returnSearchResults().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, null, null);
        $result = $productController->returnSearchResults();   

        // Check if the amount of results returned is 2.
        $this->assertCount(2, json_decode($result['variables']['response'], true)['results']);
    }

    // editProductForm() Tests
    function testEditProductFormNoId() {
        // Declare ProductController instance and execute editProductForm().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, null, null);
        $result = $productController->editProductForm();   

        // Check if page name is equal to 'Add Product'.
        $this->assertEquals('Add Product', $result['variables']['pageName']);
    }

    function testEditProductFormWithIdNoProduct() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue(null));

        // Declare ProductController instance and execute editProductForm().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, null, null);
        $result = $productController->editProductForm();   

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/products', xdebug_get_headers());
    }

    function testEditProductFormWithIdAndProduct() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Create product entity.
        $productEntity = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();

        // Setup value to be returned by retrieveRecord().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$productEntity]));

        // Declare ProductController instance and execute editProductForm().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, null, null);
        $result = $productController->editProductForm();   

        // Check if page name is equal to 'Add Product'.
        $this->assertEquals('Edit Product', $result['variables']['pageName']);
    }

    // editProductSubmit() Tests
    function testEditProductSubmitNoId() {
        // Define POST data.
        $testPostData = [
            'product' => 1
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Add Product', $result['variables']['pageName']);        
    }

    function testEditProductSubmitWithIdNoProduct() {
        // Define POST data.
        $testPostData = [
            'product' => 1
        ];

        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('product_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue(null));

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/products', xdebug_get_headers());
    }    

    function testEditProductSubmitNoName() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'name' => ''
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The product name cannot be blank.', $result['variables']['error']);
    }    

    function testEditProductSubmitNameNoPrice() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'name' => 'Test Product',
                'price' => ''
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The price cannot be blank.', $result['variables']['error']);
    }   

    function testEditProductSubmitNameInvalidPrice() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'name' => 'Test Product',
                'price' => 'one hundred'
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The price must be a number.', $result['variables']['error']);
    }   

    function testEditProductSubmitNamePriceNoDescription() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'name' => 'Test Product',
                'price' => '50.00',
                'description' => ''
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The description cannot be blank.', $result['variables']['error']);
    }       


    function testEditProductSubmitNamePriceDescriptionNoImageNoId() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'category_id' => '',
                'platform_id' => '',
                'genre_id' => '',
                'name' => 'Test Product',
                'price' => '50.00',
                'description' => 'This is a test product!'
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Product Added', $result['variables']['pageName']);
    }

    function testEditProductSubmitNamePriceDescriptionNoImageWithId() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Define POST data.
        $testPostData = [
            'product' => [
                'category_id' => 1,
                'platform_id' => '',
                'genre_id' => '',
                'name' => 'Test Product',
                'price' => '50.00',
                'description' => 'This is a test product!'
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, $testPostData, null);
        $result = $productController->editProductSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Product Updated', $result['variables']['pageName']);
    }

    function testEditProductSubmitNamePriceDescriptionInvalidImageMimeType() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'category_id' => 1,
                'platform_id' => '',
                'genre_id' => '',
                'name' => 'Test Product',
                'price' => '50.00',
                'description' => 'This is a test product!'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'tmp_name' => 'public/images/hal.png'
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, $testFilesData);
        $result = $productController->editProductSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The file uploaded is not a JPEG image.', $result['variables']['error']);
    }    


    function testEditProductSubmitNamePriceDescriptionImageInvalidSize() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'category_id' => 1,
                'platform_id' => '',
                'genre_id' => '',
                'name' => 'Test Product',
                'price' => '50.00',
                'description' => 'This is a test product!'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'tmp_name' => 'public/images/image-slide-placeholder.jpg'
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, $testFilesData);
        $result = $productController->editProductSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The image needs to have dimensions of 400x400.', $result['variables']['error']);
    } 

    function testEditProductSubmitNameSuccessfulNoId() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'category_id' => 1,
                'platform_id' => '',
                'genre_id' => '',
                'name' => 'Test Product',
                'price' => '50.00',
                'description' => 'This is a test product!'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'name' => 'image-placeholder.jpg',
                'tmp_name' => 'public/images/image-placeholder.jpg'
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, $testFilesData);
        $result = $productController->editProductSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Product Added', $result['variables']['pageName']);
    } 

    function testEditProductSubmitNameSuccessfulWithId() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Define POST data.
        $testPostData = [
            'product' => [
                'category_id' => 1,
                'platform_id' => '',
                'genre_id' => '',
                'name' => 'Test Product',
                'price' => '50.00',
                'description' => 'This is a test product!'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'name' => 'image-placeholder.jpg',
                'tmp_name' => 'public/images/image-placeholder.jpg'
            ]
        ];

        // Declare ProductController instance and execute editProductSubmit().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, $testGetData, $testPostData, $testFilesData);
        $result = @$productController->editProductSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Product Updated', $result['variables']['pageName']);
    } 

    // deleteProduct() Test
    function testDeleteProduct() {
        // Define POST data.
        $testPostData = [
            'product' => [
                'product_id' => 1
            ]
        ];

        // Create product entity.
        $productEntity = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity->product_id = 1;
        $productEntity->image = 'image.jpg';

        // Setup value to be returned by retrieveRecord().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('product_id'), $this->equalTo($testPostData['product']['product_id']))
            ->will($this->returnValue([$productEntity]));

        // Setup value to be returned by deleteRecordById().
        $this->mockProductsTable->expects($this->once())
            ->method('deleteRecordById')
            ->with($this->equalTo($testPostData['product']['product_id']))
            ->will($this->returnValue([$productEntity]));
    
        // Declare ProductController instance and execute viewProduct().
        $productController = new \NNGames\Controllers\ProductController($this->mockProductsTable, $this->mockCategoriesTable, $this->mockPlatformsTable,
                                                                        $this->mockGenresTable, null, $testPostData, null);
        @$productController->deleteProduct();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/products', xdebug_get_headers());        
    }
}
?>