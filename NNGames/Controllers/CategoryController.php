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

    // Method for displaying the edit category form.
    public function editCategoryForm() {
        $categories = $this->categoriesTable->retrieveAllRecords();

        if (!isset($this->get['id']))
            $pageName = 'Add Category';
        else
            $pageName = 'Edit Category';

        // Check if $_GET['id'] has been set. If so, display
        // a pre-filled edit category (Edit Category) form.
        if (isset($this->get['id'])) {
            $category = $this->categoriesTable->retrieveRecord('category_id', $this->get['id'])[0];

            if (empty($category))
                header('Location: /admin/categories');

            if ($category->parent_id != null)
                $parentCategory = $this->categoriesTable->retrieveRecord('category_id', $category->parent_id)[0];
            else
                $parentCategory = null;

            return [
                'layout' => 'adminlayout.html.php',
                'template' => 'pages/admin/editcategory.html.php',
                'variables' => [
                    'category' => $category,
                    'parentCategory' => $parentCategory,
                    'categories' => $categories,
                    'pageName' => $pageName
                ],
                'title' => 'Admin Panel - ' . $pageName
            ];   
        }
        else {
            return [
                'layout' => 'adminlayout.html.php',
                'template' => 'pages/admin/editcategory.html.php',
                'variables' => [
                    'categories' => $categories,
                    'pageName' => $pageName
                ],
                'title' => 'Admin Panel - ' . $pageName
            ];        
        }
    }

    // Method for adding/updating a category in the databse.
    public function editCategorySubmit() {
        $categories = $this->categoriesTable->retrieveAllRecords();

        if (isset($this->post['category'])) {
            if (isset($this->get['id'])) {
                $category = $this->categoriesTable->retrieveRecord('category_id', $this->get['id'])[0];

                if (empty($category))
                    header('Location: /admin/categories');

                if ($category->parent_id != null)
                    $parentCategory = $this->categoriesTable->retrieveRecord('category_id', $category->parent_id)[0];
                else
                    $parentCategory = null;
            }
            else {
                $category = '';
                $parentCategory = '';
            }

            if ($this->post['category']['name'] == '')
                $error = 'The category name cannot be blank.';

            if (!isset($error)) {
                if (isset($this->get['id'])) {
                    $pageName = 'Category Updated';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/success/editcategorysuccess.html.php';
                }
                else {
                    $pageName = 'Category Added';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/success/editcategorysuccess.html.php';
                }

                if ($this->post['category']['parent_id'] == '')
                    $this->post['category']['parent_id'] = null;

                $this->categoriesTable->save($this->post['category']);

                $variables = [
                    'pageName' => $pageName,
                    'categoryName' => htmlspecialchars(strip_tags($this->post['category']['name']), ENT_QUOTES, 'UTF-8')
                ];
            }
            else {
                if (isset($_GET['id'])) {
                    $pageName = 'Edit Category';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/editcategory.html.php';
                }
                else {
                    $pageName = 'Add Category';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/editcategory.html.php';
                }
                
                $variables = [
                    'pageName' => $pageName,
                    'error' => $error,
                    'categories' => $categories,
                    'parentCategory' => $parentCategory,
                    'category' => $category
                ];
            }
        }

        return [
            'layout' => $layout,
            'template' => $template,
            'variables' => $variables,
            'title' => 'Admin Panel - ' . $pageName
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

            $this->categoriesTable->save($values);
        }

        $this->categoriesTable->deleteRecordById($this->post['category']['category_id']);

        header('Location: /admin/categories');
    }
}
?>