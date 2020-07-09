<?php
require 'NNGames/Entities/Category.php';
require 'CSY2028/DatabaseTable.php';

class CategoryEntityTest extends \PHPUnit\Framework\TestCase {
    private $mockCategoriesTable;
    private $mockProductsTable;

    private $categoriesTable;
    private $platformsTable;
    private $genresTable;
    private $productsTable;

    public function setUp() {
        // Setup database connection.
        //require 'dbConnection.php';
        require 'dbConnection.vagrant.php';
        $this->pdo = $pdo;

        // Declare mock database tables instances.
        $this->mockCategoriesTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
        $this->mockProductsTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();

        // Declare actual database table instances;
        $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'category_id');
        $this->platformsTable = new \CSY2028\DatabaseTable($pdo, 'platforms', 'platform_id', '\NNGames\Entities\Platform');
        $this->genresTable = new \CSY2028\DatabaseTable($pdo, 'genres', 'genre_id', '\NNGames\Entities\Genre');
        $this->productsTable = new \CSY2028\DatabaseTable($pdo, 'products', 'product_id', '\NNGames\Entities\Product', [$this->categoriesTable, $this->platformsTable, $this->genresTable]);
        $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'category_id', '\NNGames\Entities\Category', [$this->categoriesTable, $this->productsTable]);
    }

    /* Category Entity Tests */
    // getChildCategories() Test
    function testGetChildCategories() {
        // Declare mock category entities.
        $categoryEntity1 = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity2 = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity2 = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        
        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$categoryEntity1, $categoryEntity2, $categoryEntity2]));

        // Declare test category entity instance and fetch "child categories".
        $testCategoryEntity = new \NNGames\Entities\Category($this->mockCategoriesTable, $this->mockProductsTable);
        $result = $testCategoryEntity->getChildCategories();

        // Check that the resulting array has 3 entries.
        $this->assertCount(3, $result);

    }
    
    // getProductsCount() Test
    function testGetProductsCount() {
        // Declare mock product entities.
        $productEntity1 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity2 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();
        $productEntity3 = $this->getMockBuilder('\NNGames\Entities\Product')->disableOriginalConstructor()->getMock();

        // Setup value to be returned by retrieveRecord().
        $this->mockProductsTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$productEntity1, $productEntity2, $productEntity3]));

        // Declare test category entity instance and fetch products count.
        $testCategoryEntity = new \NNGames\Entities\Category($this->mockCategoriesTable, $this->mockProductsTable);
        $result = $testCategoryEntity->getProductsCount();

        // Check that the result is equal to 3.
        $this->assertEquals(3, $result);
    }

    // getTotalProductsCount() Test - !!! REQUIRES DATABASE CONNECTION !!!
    function testGetTotalProductsCount() {
        // Declare test category entity instance and set category_id to 1.
        $testCategoryEntity = new \NNGames\Entities\Category($this->categoriesTable, $this->productsTable);
        $testCategoryEntity->category_id = 1;

        // Fetch total products count.
        $result = $testCategoryEntity->getTotalProductsCount();

        // Check that the result is equal to 3.
        $this->assertEquals(3, $result); // Category: PlayStation - Child Categories Amount: 3
    }
}
?>