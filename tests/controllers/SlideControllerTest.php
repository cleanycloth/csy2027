<?php
require 'NNGames/Controllers/SlideController.php';

class SlideControllerTest extends \PHPUnit\Framework\TestCase {
    private $mockSlidesTable;

    public function setUp() {
        $this->mockSlidesTable = $this->getMockBuilder('\CSY2028\DatabaseTable')->disableOriginalConstructor()->getMock();
    }

    /* SlideController Tests */
    // listSlides() Test
    function testListSlides() {
        // Declare mock slide entities.
        $slideEntity1 = $this->getMockBuilder('\NNGames\Entities\Slide')->disableOriginalConstructor()->getMock();
        $slideEntity2 = $this->getMockBuilder('\NNGames\Entities\Slide')->disableOriginalConstructor()->getMock();
        $slideEntity3 = $this->getMockBuilder('\NNGames\Entities\Slide')->disableOriginalConstructor()->getMock();
        
        // Setup value to be returned by retrieveAllRecords().
        $this->mockSlidesTable->expects($this->once())
            ->method('retrieveAllRecords')
            ->will($this->returnValue([$slideEntity1, $slideEntity2, $slideEntity3]));

        // Declare SlideController instance and execute listSlides().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, null, null);
        $result = $slideController->listSlides();

        // Check if title and amount of categories are returned as expected.
        $this->assertEquals('Admin Panel - Slides', $result['title']);
        $this->assertCount(3, $result['variables']['slides']);
    }

    // editSlideForm() Tests
    function testEditSlideFormNoId() {
        // Declare SlideController instance and execute editSlideForm().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, null, null);
        $result = $slideController->editSlideForm();

        $this->assertEquals('Add Slide', $result['variables']['pageName']);
    }

    function testEditSlideFormWithIdNoSlide() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Declare mock slide entity.
        $slideEntity = $this->getMockBuilder('\NNGames\Entities\Slide')->disableOriginalConstructor()->getMock();

        // Setup value to be returned by retrieveRecord().
        $this->mockSlidesTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('slide_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue([$slideEntity]));

        // Declare SlideController instance and execute editSlideForm().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, $testGetData, null, null);
        $result = $slideController->editSlideForm();

        // Check if pageName is returned as expected.
        $this->assertEquals('Edit Slide', $result['variables']['pageName']);
    }

    function testEditSlideFormWithIdWithSlide() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Setup value to be returned by retrieveRecord().
        $this->mockSlidesTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('slide_id'), $this->equalTo($testGetData['id']))
            ->will($this->returnValue(null));

        // Declare SlideController instance and execute editSlideForm().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, $testGetData, null, null);
        $slideController->editSlideForm();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/slides', xdebug_get_headers());
    }

    // editSlideSubmit() Tests
    function testEditSlideSubmitNoId() {
        // Define POST data.
        $testPostData = [
            'slide' => 1
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Add Slide', $result['variables']['pageName']);
    }

    function testEditSlideSubmitWithIdNoSlide() {
        // Define POST data.
        $testPostData = [
            'slide' => 1
        ];

        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, $testGetData, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/slides', xdebug_get_headers());
    }

    function testEditSlideSubmitNoName() {
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => ''
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The name cannot be blank', $result['variables']['error']);
    }

    function testEditSlideSubmitNameNoMessage() {
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => ''
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The message cannot be blank.', $result['variables']['error']);
    }

    function testEditSlideSubmitNameMessageNoUrl() {
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => ''
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The URL cannot be blank.', $result['variables']['error']);
    }

    function testEditSlideSubmitNameMessageInvalidUrl() {
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => 'test'
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The URL is not valid.', $result['variables']['error']);
    }

    function testEditSlideSubmitNameMessageUrlNoImage() {
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => 'https://csy2027.v.je/'
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('Slide Added', $result['variables']['pageName']);
    }

    function testEditSlideSubmitNameMessageUrlNoImageWithId() {
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];
        
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => 'https://csy2027.v.je/'
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, $testGetData, $testPostData, null);
        $result = $slideController->editSlideSubmit();

        // Check if pageName is returned as expected.
        $this->assertEquals('Slide Updated', $result['variables']['pageName']);
    }

    function testEditSlideSubmitNameMessageUrlInvalidImageMimeType() { 
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => 'https://csy2027.v.je/'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'tmp_name' => 'public/images/hal.png'
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, $testFilesData);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The file uploaded is not a JPEG image.', $result['variables']['error']);
    }

    function testEditSlideSubmitNameMessageUrlValidImageInvalidSize() { 
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => 'https://csy2027.v.je/'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'tmp_name' => 'public/images/image-placeholder.jpg'
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, $testFilesData);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('The image needs to have dimensions of 1920x500.', $result['variables']['error']);
    }
    
    function testEditSlideSubmitSuccessfulNoId() { 
        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => 'https://csy2027.v.je/'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'name' => 'image-slide-placeholder.jpg',
                'tmp_name' => 'public/images/image-slide-placeholder.jpg'
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, $testFilesData);
        $result = $slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('Slide Added', $result['variables']['pageName']);
    }

    function testEditSlideSubmitSuccessfulWithId() { 
        // Define GET data.
        $testGetData = [
            'id' => 1
        ];

        // Define POST data.
        $testPostData = [
            'slide' => [
                'name' => 'Test Slide',
                'message' => 'This is a test slide!',
                'url' => 'https://csy2027.v.je/'
            ]
        ];

        // Define FILES data.
        $testFilesData = [
            'image' => [
                'name' => 'image-slide-placeholder.jpg',
                'tmp_name' => 'public/images/image-slide-placeholder.jpg'
            ]
        ];

        // Declare SlideController instance and execute editSlideSubmit().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, $testGetData, $testPostData, $testFilesData);
        $result = @$slideController->editSlideSubmit();

        // Check if error is returned as expected.
        $this->assertEquals('Slide Updated', $result['variables']['pageName']);
    }

    // deleteSlide() Test
    function testDeleteSlide() {
        // Define POST data.
        $testPostData = [
            'slide' => [
                'slide_id' => 1
            ]
        ];

        // Declare mock slide entity.
        $slideEntity = $this->getMockBuilder('\NNGames\Entities\Slide')->disableOriginalConstructor()->getMock();
        $slideEntity->image = 'URL';

        // Setup value to be returned by retrieveRecord().
        $this->mockSlidesTable->expects($this->once())
            ->method('retrieveRecord')
            ->with($this->equalTo('slide_id'), $this->equalTo($testPostData['slide']['slide_id']))
            ->will($this->returnValue([$slideEntity]));

        // Setup value to be returned by retrieveRecord().
        $this->mockSlidesTable->expects($this->once())
            ->method('deleteRecordById')
            ->with($this->equalTo($testPostData['slide']['slide_id']));

        // Declare SlideController instance and execute deleteSlides().
        $slideController = new \NNGames\Controllers\SlideController($this->mockSlidesTable, null, $testPostData, null);
        @$slideController->deleteSlide();

        // Check if header is set/returned as expected.
        $this->assertContains('Location: /admin/slides', xdebug_get_headers());
    } 
}
?>