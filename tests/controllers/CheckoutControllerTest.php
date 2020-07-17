<?php
require 'NNGames/Controllers/CheckoutController.php';

class CheckoutControllerTest extends \PHPUnit\Framework\TestCase {
    private $checkoutController;

    public function setUp() {
        $this->checkoutController = new \NNGames\Controllers\CheckoutController(); 
    }

    /* CheckoutController Tests */
    // checkoutReviewBasket() Test
    public function testCheckoutReviewBasket() {        
        $array = $this->checkoutController->checkoutReviewBasket();

        $this->assertEquals('Checkout - Review Basket', $array['title']);
    }

    // checkoutAddress() Test
    public function testCheckoutAddress() {        
        $array = $this->checkoutController->checkoutAddress();

        $this->assertEquals('Checkout - Address/Contact Info', $array['title']);
    }

    // checkoutPaymentDetails() Test
    public function testCheckoutPaymentDetails() {        
        $array = $this->checkoutController->checkoutPaymentDetails();

        $this->assertEquals('Checkout - Payment Details', $array['title']);
    }

    // checkoutCompleted() Test
    public function testCheckoutCompleted() {        
        $array = $this->checkoutController->checkoutCompleted();

        $this->assertEquals('Checkout - Completed', $array['title']);
    }
}
?>