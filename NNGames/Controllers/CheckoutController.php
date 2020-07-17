<?php
namespace NNGames\Controllers;
class CheckoutController {
    public function checkoutReviewBasket() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/main/checkoutbasket.html.php',
            'variables' => []
            'title' => 'Checkout - Review Basket'
        ];
    }

    public function checkoutAddress() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/main/checkoutaddress.html.php',
            'variables' => [],
            'title' => 'Checkout - Address/Contact Info'
        ];
    }

    public function checkoutPaymentDetails() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/main/checkoutpayment.html.php',
            'variables' => [],
            'title' => 'Checkout - Payment Details'
        ];
    }

    public function checkoutCompleted() {
        return [
            'layout' => 'layout.html.php',
            'template' => 'pages/main/checkoutcompleted.html.php',
            'variables' => [],
            'title' => 'Checkout - Completed'
        ];
    }
}
?>