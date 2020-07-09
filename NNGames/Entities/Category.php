<?php
namespace NNGames\Entities;
class Category {
    public $category_id;
    public $parent_id;
    public $name;

    private $categoriesTable;
    private $productsTable;

    public function __construct(\CSY2028\DatabaseTable $categoriesTable, \CSY2028\DatabaseTable $productsTable) {
        $this->categoriesTable = $categoriesTable;
        $this->productsTable = $productsTable;
    }

    public function getChildCategories() {
        return $this->categoriesTable->retrieveRecord('parent_id', $this->category_id);
    }

    public function getProductsCount() {
        return count($this->productsTable->retrieveRecord('category_id', $this->category_id));
    }

    public function getTotalProductsCount() {
        $count = $this->getProductsCount();
        foreach ($this->getChildCategories() as $childCategory) {
            $count = $count + $childCategory->getProductsCount();
        }

        return $count;
    }
}
?>