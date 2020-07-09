<?php
require 'NNGames/Controllers/BasketController.php';

class BasketControllerTest extends \PHPUnit\Framework\TestCase {
    private $mockProductsTable;
    private $productsTable;

    public function setUp() {
        //require 'dbConnection.php';
        require 'dbConnection.vagrant.php';

        $this->pdo = $pdo;

        $this->productsTable = new \CSY2028\DatabaseTable($pdo, 'products', 'product_id');

        // Declare mock products table.#
        $this->mockProductsTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
    }

    /* BasketController Tests */
    // addItemToBasket() Tests
    function testAddItemToBasketNewBasket() {
        $testPostData = [
            'productId' => '1',
            'quantity' => '3'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->addToBasket();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Item has been added to your basket!', $jsonResponse['status']);
        $this->assertEquals(1, $_SESSION['basket'][0]['productId']);
    }
    
    function testAddItemToBasketExistingBasket() {
        $testPostData = [
            'productId' => '2',
            'quantity' => '3'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->addToBasket();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Item has been added to your basket!', $jsonResponse['status']);
        $this->assertEquals(2, $_SESSION['basket'][1]['productId']);
    }

    function testAddItemToBasketExistingItem() {
        $testPostData = [
            'productId' => '1',
            'quantity' => '2'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->addToBasket();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Item has been added to your basket!', $jsonResponse['status']);
        $this->assertEquals(5, $_SESSION['basket'][0]['quantity']);
    }

    function testAddItemToBasketMaxQtyNotInBasket() {
        $testPostData = [
            'productId' => '3',
            'quantity' => '100'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->addToBasket();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Item could not be added. (Max. Quantity: 99)', $jsonResponse['status']);
    }

    function testAddItemToBasketMaxQtyInBasket() {
        $testPostData = [
            'productId' => '2',
            'quantity' => '97'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->addToBasket();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Item could not be added. (Max. Quantity: 99)', $jsonResponse['status']);
        $this->assertEquals(99, $_SESSION['basket'][1]['quantity']);
    }

    // updateItemQuantity() Tests - Updating quantity on an item that exists and doe not exist in the basket.
    function testUpdateItemQuantity() {
        $testPostData = [
            'productId' => '1',
            'quantity' => '50'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->updateItemQuantity();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Quantity for product (ID: 1) updated in basket.', $jsonResponse['status']);
        $this->assertEquals(50, $_SESSION['basket'][0]['quantity']);
    }

    function testUpdateItemQuantityDoesNoExist() {
        $testPostData = [
            'productId' => '4',
            'quantity' => '20'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->updateItemQuantity();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Item does not exist in basket.', $jsonResponse['status']);
    }


    // getBasketContents() Test - Existing Basket - !!! REQUIRES DATABASE CONNECTION !!!
    function testGetBasketContents() {
        $basketController = new \NNGames\Controllers\BasketController($this->productsTable, null, null);
        
        $result = $basketController->getBasketContents();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Basket has 2 product(s).', $jsonResponse['status']);
    }

    // removeFromBasket() Test - Existing Basket
    function testRemoveFromBasket() {
        $testPostData = [
            'productId' => '1'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->removeFromBasket();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('Product removed from basket.', $jsonResponse['status']);
    }

    // getBasketContents() Test - Empty Basket
    function testGetBasketContentsEmpty() {
        $_SESSION['basket'] = [];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, null);
        
        $result = $basketController->getBasketContents();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('User does not have any items in their basket.', $jsonResponse['status']);
    }

    // getBasketContents() Test - No Basket
    function testGetBasketContentsNoBasket() {
        unset($_SESSION['basket']);

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, null);
        
        $result = $basketController->getBasketContents();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('User does not have a basket.', $jsonResponse['status']);
    }

    // updateItemQuantity() Test - No Basket
    function testUpdateItemQuantityNoBasket() {
        $testPostData = [
            'productId' => '1',
            'quantity' => '15'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);
        
        $result = $basketController->updateItemQuantity();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('User has no basket.', $jsonResponse['status']);
    }

    // removeFromBasket() Test - No Basket
    function testRemoveFromBasketNoBasket() {
        $testPostData = [
            'productId' => '1'
        ];

        $basketController = new \NNGames\Controllers\BasketController($this->mockProductsTable, null, $testPostData);

        $result = $basketController->removeFromBasket();
        $jsonResponse = json_decode($result['variables']['response'], true);

        $this->assertEquals('User does not have a basket.', $jsonResponse['status']);
    }
}
?>