<?php
namespace NNGames\Controllers;
class CategoryController {
    private $categoriesTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $categoriesTable, $get, $post) {
        $this->categoriesTable = $categoriesTable;
        $this->get = $get;
        $this->post = $post;
    }

    // Method for listing out all categories in the database.
    public function listCategories() {
        $categories = $this->categoriesTable->retrieveAllRecords();

        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/categories.html.php',
            'variables' => [
                'categories' => $categories,
            ],
            'title' => 'Admin Panel - Categories'
        ];
    }

    // Method for deleting a category from the database.
    public function deleteCategory() {
        $childCategories = $this->categoriesTable->retrieveRecord('category_id', $this->post['category']['category_id'])[0]->getChildCategories();

        foreach($childCategories as $childCategory) {
            $values = [
                'category_id' => $childCategory->category_id,
                'parent_id' => null
            ];

            $this->categoriesTables->save($values);
        }

        $this->categoriesTable->deleteRecordById($this->post['category']['category_id']);

        header('Location: /admin/categories');
    }
}
?>