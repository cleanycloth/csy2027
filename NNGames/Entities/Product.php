<?php
namespace NNGames\Entities;
class Product {
    public $product_id;
    public $category_id;
    public $platform_id;
    public $genre_id;
    public $image_id;
    public $name;
    public $price;
    public $description;

    private $categoriesTable;

    public function __construct() {
        require '../dbConnection.php';
        $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'categories', 'category_id', '\NNGames\Entities\Category');
        $this->platformsTable = new \CSY2028\DatabaseTable($pdo, 'platforms', 'platform_id');
        $this->genresTable = new \CSY2028\DatabaseTable($pdo, 'genres', 'genre_id');
    }

    public function getCategoryName() {
        $category = $this->categoriesTable->retrieveRecord('category_id', $this->category_id);

        if (!empty($category))
            $categoryName = $category[0]->name;
        else
            $categoryName = 'None';

        return $categoryName;
    }

    public function getPlatformName() {
        $platform = $this->platformsTable->retrieveRecord('platform_id', $this->platform_id);

        if (!empty($platform))
            $platformName = $platform[0]->name;
        else
            $platformName = 'None';

        return $platformName;
    }

    public function getGenreName() {
        $genre = $this->genresTable->retrieveRecord('genre_id', $this->genre_id);

        if (!empty($genre))
            $genreName = $genre[0]->name;
        else
            $genreName = 'None';

        return $genreName;
    }
}
?>