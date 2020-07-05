<?php
namespace NNGames\Entities;
class Category {
    public $category_id;
    public $parent_id;
    public $name;

    private $categoriesTable;
    private $productsTable;

    public function __construct() {
        require '../dbConnection.php';
        $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'category_id', '\NNGames\Entities\Category');
        $this->productsTable = new \CSY2028\DatabaseTable($pdo, 'products', 'product_id');
    }

    public function getChildCategories() {
        return $this->categoriesTable->retrieveRecord('parent_id', $this->category_id);
    }

    public function getProductsCount() {
        return count($this->productsTable->retrieveRecord('category_id', $this->category_id));
    }
}
?>