<?php
namespace NNGames\Controllers;
class BasketController {
    private $productsTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $productsTable, $get, $post) {
        $this->productsTable = $productsTable;
        $this->get = $get;
        $this->post = $post;
    }

    // Method for adding a product to the user's basket.
    public function addToBasket() {
        if (isset($_SESSION['basket'])) {
            $alreadyInBasket = false;
            foreach ($_SESSION['basket'] as $key=>$basketItem) {
                if ((int)$this->post['productId'] == $basketItem['productId']) {
                    $_SESSION['basket'][$key]['quantity'] = (int)$this->post['quantity'];
                    $alreadyInBasket = true;
                    break;
                }
            }

            if ($alreadyInBasket) {
                $values = [
                    'status' => 'Quantity for product (ID: ' . $this->post['productId'] . ') updated in basket'
                ];
            }
            else {
                $_SESSION['basket'][] = [
                    'productId' => (int)$this->post['productId'],
                    'quantity' => (int)$this->post['quantity']
                ];
        
                $values = [
                    'status' => 'Product added to basket'
                ]; 
            }
        }
        else {
            $_SESSION['basket'][] = [
                'productId' => (int)$this->post['productId'],
                'quantity' => (int)$this->post['quantity']
            ];

            $values = [
                'status' => 'User has no basket. Initialising new basket.'
            ];
        }

        return [
            'layout' => 'blanklayout.html.php',
            'template' => 'json/response.html.php',
            'variables' => [
                'response' => json_encode($values)
            ],
            'title' => 'JSON Response'
        ];
    }

    // Method for retrieving all items currently in the user's basket.
    public function getBasketContents() {
        if (isset($_SESSION['basket'])) {
            if (count($_SESSION['basket']) > 0) {
                foreach ($_SESSION['basket'] as $basketItem) {
                    $product = $this->productsTable->retrieveRecord('product_id', $basketItem['productId'])[0];
        
                    $values[] = [
                        'productId' => $product->product_id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $basketItem['quantity'],
                        'imageUrl' => $product->image 
                    ];
                }
            }
            else {
                $values = [
                    'status' => 'User does not have any items in their basket.'
                ];
            }
        }
        else {
            $values = [
                'status' => 'User does not have a basket.'
            ];
        }

        return [
            'layout' => 'blanklayout.html.php',
            'template' => 'json/response.html.php',
            'variables' => [
                'response' => json_encode($values)
            ],
            'title' => 'JSON Response'
        ];
    }

    // Method for removing an item from the user's basket.
    public function removeFromBasket() {
        if (isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $key=>$basketItem) {
                if ($this->post['productId'] == $basketItem['productId']) {
                    unset($_SESSION['basket'][$key]);
                    break;
                }
            }
    
            $values = [
                'status' => 'Product removed from basket.'
            ];
        }
        else {
            $values = [
                'status' => 'User does not have a basket.'
            ];
        }

        return [
            'layout' => 'blanklayout.html.php',
            'template' => 'json/response.html.php',
            'variables' => [
                'response' => json_encode($values)
            ],
            'title' => 'JSON Response'
        ];
    }
}
?>