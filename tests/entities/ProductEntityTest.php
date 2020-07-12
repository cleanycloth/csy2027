<?php
require 'NNGames/Entities/Product.php';

class ProductEntityTest extends \PHPUnit\Framework\TestCase {
    private $mockProductsTable;
    private $mockCategoriesTable;
    private $mockPlatformsTable;
    private $mockGenresTable;

    public function setUp() {
        // Declare mock database tables instances.
        $this->mockProductsTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
        $this->mockCategoriesTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
        $this->mockPlatformsTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
        $this->mockGenresTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
    }

    /* Product Entity Tests */
    // getCategoryName() Tests
    public function testGetCategoryName() {     
        // Declare dummy category entity.  
        $categoryEntity = new \NNGames\Entities\Category($this->mockCategoriesTable, $this->mockProductsTable);
        $categoryEntity->name = 'Test Category';
        
        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$categoryEntity]));

        // Declare product entity instance and fetch category name.
        $productEntity = new \NNGames\Entities\Product($this->mockCategoriesTable, $this->mockPlatformsTable, $this->mockGenresTable);
        $result = $productEntity->getCategoryName();

        // Check that the value returned is 'Test Category'.        
        $this->assertEquals('Test Category', $result);
    }

    public function testGetCategoryNameNone() {        
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord');

        // Declare product entity instance and fetch category name.
        $productEntity = new \NNGames\Entities\Product($this->mockCategoriesTable, $this->mockPlatformsTable, $this->mockGenresTable);
        $result = $productEntity->getCategoryName();

        // Check that the value returned is 'None'.
        $this->assertEquals('None', $result);
    }

    // getPlatformName() Tests
    public function testGetPlatformName() { 
        // Declare dummy platform entity.    
        $platformEntity = new \NNGames\Entities\Platform();
        $platformEntity->name = 'Test Platform';
        
        // Setup value to be returned by retrieveRecord().
        $this->mockPlatformsTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$platformEntity]));

        // Declare product entity instance and fetch platform name.
        $productEntity = new \NNGames\Entities\Product($this->mockCategoriesTable, $this->mockPlatformsTable, $this->mockGenresTable);
        $result = $productEntity->getPlatformName();

        // Check that the value returned is 'Test Platform'.
        $this->assertEquals('Test Platform', $result);
    }

    public function testGetPlatformNameNone() {        
        $this->mockPlatformsTable->expects($this->once())
            ->method('retrieveRecord');

        // Declare product entity instance and fetch platform name.
        $productEntity = new \NNGames\Entities\Product($this->mockCategoriesTable, $this->mockPlatformsTable, $this->mockGenresTable);
        $result = $productEntity->getPlatformName();

        // Check that the value returned is 'None'.
        $this->assertEquals('None', $result);
    }

    // getGenreName() Tests
    public function testGetGenreName() {   
        // Declare dummy genre entity.  
        $genreEntity = new \NNGames\Entities\Genre();
        $genreEntity->name = 'Test Genre';
        
        // Setup value to be returned by retrieveRecord().
        $this->mockGenresTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$genreEntity]));

        // Declare product entity instance and fetch genre name.
        $productEntity = new \NNGames\Entities\Product($this->mockCategoriesTable, $this->mockPlatformsTable, $this->mockGenresTable);
        $result = $productEntity->getGenreName();

        // Check that the value returned is 'Test Genre'.
        $this->assertEquals('Test Genre', $result);
    }

    public function testGetGenreNameNone() {        
        $this->mockGenresTable->expects($this->once())
            ->method('retrieveRecord');

        // Declare product entity instance and fetch genre name.
        $productEntity = new \NNGames\Entities\Product($this->mockCategoriesTable, $this->mockPlatformsTable, $this->mockGenresTable);
        $result = $productEntity->getGenreName();

        // Check that the value returned is 'None'.
        $this->assertEquals('None', $result);
    }
}
?>