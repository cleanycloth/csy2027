<?php
require 'NNGames/Controllers/CategoryController.php';

class CategoryControllerTest extends \PHPUnit\Framework\TestCase {
    private $mockCategoriesTable;

    public function setUp() {
        $this->mockCategoriesTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
    }

    /* CategoryController Tests */
    // listCategories() Test
    function testListCategories() {
        // Declare mock category entities.
        $categoryEntity1 = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity2 = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity2 = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        
        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue([$categoryEntity1, $categoryEntity2, $categoryEntity2]));

        // Declare CategoryController instance and execute editCategoryForm().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, null, null);
        $result = $categoryController->listCategories();

        // Check if title and amount of categories are returned as expected.
        $this->assertEquals('Admin Panel - Categories', $result['title']);
        $this->assertCount(3, $result['variables']['categories']);
    }

    // editCategoryForm() Tests
    function testEditCategoryFormNoId() {     
        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));

        // Declare CategoryController instance and execute editCategoryForm().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, null, null);
        $result = $categoryController->editCategoryForm();

        // Check if page name is returned as expected.
        $this->assertEquals('Add Category', $result['variables']['pageName']);
    }

    function testEditCategoryFormWithInvalidId() {
        // Define GET values.
        $values = [
            'id' => 1
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue(null));

        // Declare CategoryController instance and execute editCategoryForm().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, $values, null);
        $categoryController->editCategoryForm();
        
        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/categories', xdebug_get_headers());
    }

    function testEditCategoryFormWithValidIdParentCategory() {
        // Define GET values.
        $values = [
            'id' => 1
        ];

        // Declare mock category with a parent_id of null.
        $categoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity->parent_id = null;

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$categoryEntity]));

        // Declare CategoryController instance and execute editCategoryForm().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, $values, null);
        $result = $categoryController->editCategoryForm();

        // Check if page name is returned as expected.
        $this->assertEquals('Edit Category', $result['variables']['pageName']);
    }

    function testEditCategoryFormWithValidIdChildCategory() {
        // Define GET values.
        $values = [
            'id' => 2
        ];

        // Declare mock category with a parent_id of 1.
        $categoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity->parent_id = 1;

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->any())
            ->method('retrieveRecord')
            ->will($this->returnValue([$categoryEntity]));

        // Declare CategoryController instance and execute editCategoryForm().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, $values, null);
        $result = $categoryController->editCategoryForm();

        // Check if page name is returned as expected.
        $this->assertEquals('Edit Category', $result['variables']['pageName']);
    }

    // editCategorySubmit() Tests
    function testEditCategorySubmitNoId() {
        $testPostData = [
            'category' => 1
        ];

        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));

        // Declare CategoryController instance and execute editCategorySubmit().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, null, $testPostData);
        $result = $categoryController->editCategorySubmit();

        $this->assertEquals('Add Category', $result['variables']['pageName']);
    }

    function testEditCategorySubmitWithIdNoCategory() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];
        
        // Define POST data.
        $testPostData = [
            'category' => 1
        ];

        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue(null));

        // Declare CategoryController instance and execute editCategorySubmit().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, $testGetData, $testPostData);
        $categoryController->editCategorySubmit();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/categories', xdebug_get_headers());
    }

    function testEditCategorySubmitWithIdParentCategory() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];
        
        // Define POST data.
        $testPostData = [
            'category' => 1
        ];

        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));


        // Declare mock category with a parent_id of null.
        $categoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity->parent_id = null;

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->will($this->returnValue([$categoryEntity]));

        // Declare CategoryController instance and execute editCategorySubmit().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, $testGetData, $testPostData);
        $result = $categoryController->editCategorySubmit();

        // Check if page name is returned as expected.
        $this->assertEquals('Edit Category', $result['variables']['pageName']);
    }

    function testEditCategorySubmitWithIdChildCategory() {
        // Define GET data.
        $testGetData = [
            'id' => 2
        ];
        
        // Define POST data.
        $testPostData = [
            'category' => 1
        ];

        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));


        // Declare mock category with a parent_id of null.
        $categoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $categoryEntity->parent_id = 1;

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->any())
            ->method('retrieveRecord')
            ->will($this->returnValue([$categoryEntity]));

        // Declare CategoryController instance and execute editCategorySubmit().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, $testGetData, $testPostData);
        $result = $categoryController->editCategorySubmit();

        // Check if page name is returned as expected.
        $this->assertEquals('Edit Category', $result['variables']['pageName']);
    }

    function testEditCategorySubmitNoIdAndName() {
        // Define POST data.
        $testPostData = [
            'category' => [
                'name' => 'Test Category',
                'parent_id' => ''
            ]
        ];

        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));

        // Setup value to be returned by save().
        $this->mockCategoriesTable->expects($this->once())
            ->method('save')
            ->with($this->equalTo($testPostData['category']));

        // Declare CategoryController instance and execute editCategorySubmit().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, null, $testPostData);
        $result = $categoryController->editCategorySubmit();

        // Check if page name is returned as expected.
        $this->assertEquals('Category Added', $result['variables']['pageName']);
    }

    function testEditCategorySubmitWithIdAndName() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Define POST data.
        $testPostData = [
            'category' => [
                'name' => 'Test Category',
                'parent_id' => ''
            ]
        ];

        // Setup value to be returned by retrieveAllRecords().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue(null));

        // Setup value to be returned by save().
        $this->mockCategoriesTable->expects($this->once())
            ->method('save')
            ->with($this->equalTo($testPostData['category']));

        // Declare CategoryController instance and execute editCategorySubmit().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, $testGetData, $testPostData);
        $result = $categoryController->editCategorySubmit();

        // Check if page name is returned as expected.
        $this->assertEquals('Category Updated', $result['variables']['pageName']);
    }

    // deleteCategory() Tests
    function testDeleteCategoryNoChildren() {
        // Define POST data.
        $testPostData = [
            'category' => [
                'category_id' => 1
            ]
        ];

        // Declare mock parent category.
        $parentCategoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        
        // Setup value to be returned by getChildCategories().
        $parentCategoryEntity->expects($this->once())
            ->method('getChildCategories')
            ->will($this->returnValue([]));

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('category_id'), 1)
            ->will($this->returnValue([$parentCategoryEntity]));
    
        // Setup value to be returned by deleteRecordById().
        $this->mockCategoriesTable->expects($this->once())
            ->method('deleteRecordById')
            ->with($this->equalTo($testPostData['category']['category_id']));

        // Declare CategoryController instance and execute deleteCategory().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, null, $testPostData);
        $categoryController->deleteCategory();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/categories', xdebug_get_headers());
    }

    function testDeleteCategoryWithChildren() {
        // Define POST data.
        $testPostData = [
            'category' => [
                'category_id' => 1
            ]
        ];

        // Declare mock parent category.
        $parentCategoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();

        // Declare mock child category.
        $childCategoryEntity = $this->getMockBuilder('\NNGames\Entities\Category')->disableOriginalConstructor()->getMock();
        $childCategoryEntity->category_id = 1;
        
        // Setup value to be returned by getChildCategories().
        $parentCategoryEntity->expects($this->once())
            ->method('getChildCategories')
            ->will($this->returnValue([$childCategoryEntity]));

        // Setup value to be returned by retrieveRecord().
        $this->mockCategoriesTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('category_id'), 1)
            ->will($this->returnValue([$parentCategoryEntity]));

        // Setup value to be returned by save().
        $this->mockCategoriesTable->expects($this->once())
            ->method('save')
            ->with([
                'category_id' => $childCategoryEntity->category_id,
                'parent_id' => null
            ]);

        // Setup value to be returned by deleteRecordById().
        $this->mockCategoriesTable->expects($this->once())
            ->method('deleteRecordById')
            ->with($this->equalTo($testPostData['category']['category_id']));

        // Declare CategoryController instance and execute deleteCategory().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, null, $testPostData);
        $categoryController->deleteCategory();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/categories', xdebug_get_headers());
    }

    // removeChildCategory() Test
    function testRemoveChildCategory() {
        // Define POST data.
        $testPostData = [
            'category' => [
                'category_id' => 2,
                'parent_id' => 1
            ]
        ];

        // Setup value to be returned by save().
        $this->mockCategoriesTable->expects($this->once())
            ->method('save')
            ->with([
                'category_id' => 2,
                'parent_id' => null
            ]);

        // Declare CategoryController instance and execute deleteCategory().
        $categoryController = new \NNGames\Controllers\CategoryController($this->mockCategoriesTable, null, $testPostData);
        $categoryController->removeChildCategory();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/categories/edit?id=1', xdebug_get_headers());
    }
}
?>