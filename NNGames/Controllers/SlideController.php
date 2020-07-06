<?php
namespace NNGames\Controllers;
class SlideController {
    private $slidesTable;
    private $imagesTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $slidesTable, \CSY2028\DatabaseTable $imagesTable, $get, $post) {
        $this->slidesTable = $slidesTable;
        $this->imagesTable = $imagesTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function listSlides() {
        $slides = $this->slidesTable->retrieveAllRecords();

        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/slides.html.php',
            'variables' => [
                'slides' => $slides
            ],
            'title' => 'Admin Panel - Slides'
        ];
    }

    public function editSlideForm() {
        if (!isset($this->get['id']))
            $pageName = 'Add Slide';
        else
            $pageName = 'Edit Slide';

        // Check if $_GET['id'] has been set. If so, display
        // a pre-filled edit category (Edit Slide) form.
        if (isset($this->get['id'])) {
            $slide = $this->slidesTable->retrieveRecord('slide_id', $this->get['id'])[0];

            if (empty($slide))
                header('Location: /admin/slides');

            return [
                'layout' => 'adminlayout.html.php',
                'template' => 'pages/admin/editslide.html.php',
                'variables' => [
                    'slide' => $slide,
                    'pageName' => $pageName
                ],
                'title' => 'Admin Panel - ' . $pageName
            ];   
        }
        else {
            return [
                'layout' => 'adminlayout.html.php',
                'template' => 'pages/admin/editslide.html.php',
                'variables' => [
                    'pageName' => $pageName
                ],
                'title' => 'Admin Panel - ' . $pageName
            ];        
        }       
    }

    public function editSlideSubmit() {
        if (isset($this->post['slide'])) {
            if (isset($this->get['id'])) {
                $slide = $this->slidesTable->retrieveRecord('slide_id', $this->get['id'])[0];

                if (empty($slide))
                    header('Location: /admin/slides');
            }
            else
                $slide = '';

            $uploadedFile = $_FILES['image']['tmp_name'];

            if ($uploadedFile == '') {
                if ($this->post['slide']['name'] != '') {
                    if ($this->post['slide']['message'] != '') {
                        if ($this->post['slide']['url'] != '') {
                            if (!filter_var($this->post['slide']['url'], FILTER_VALIDATE_URL))
                                $error = 'The URL is not valid.';
                        }
                        else
                            $error = 'The URL cannot be blank.';
                    }
                    else
                        $error = 'The message cannot be blank.';
                }
                else
                    $error = 'The name cannot be blank';
            }
            else {
                if (mime_content_type($uploadedFile) == 'image/jpeg') {
                    if (getimagesize($uploadedFile)[0] == 1920 && getimagesize($uploadedFile)[1] == 500) {
                        if ($this->post['slide']['name'] != '') {
                            if ($this->post['slide']['message'] != '') {
                                if ($this->post['slide']['url'] != '') {
                                    if (!filter_var($this->post['slide']['url'], FILTER_VALIDATE_URL))
                                        $error = 'The URL is not valid.';
                                }
                                else
                                    $error = 'The URL cannot be blank.';
                            }
                            else
                                $error = 'The message cannot be blank.';
                        }
                        else
                            $error = 'The name cannot be blank';
                    }
                    else
                        $error = 'The image needs to have dimensions of 1920x500.';
                }
                else
                    $error = 'The file uploaded is not a JPEG image.';
            }

            if (!isset($error)) {
                if (isset($this->get['id'])) {
                    $pageName = 'Slide Updated';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/success/editslidesuccess.html.php';
                }
                else {
                    $pageName = 'Slide Added';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/success/editslidesuccess.html.php';
                }

                if ($_FILES['image']['tmp_name'] != '') {
                    if (isset($this->get['id'])) {
                        $imageId = $this->slidesTable->retrieveRecord('slide_id', $this->get['id'])[0]->image_id;
                        $this->imagesTable->saveBlob($imageId, $_FILES['image']['tmp_name'], $_FILES['image']['type']);
                    }
                    else {
                        $this->imagesTable->saveBlob(null, $_FILES['image']['tmp_name'], $_FILES['image']['type']);
                        $this->post['slide']['image_id'] = $this->imagesTable->lastInsertId();
                        $this->slidesTable->save($this->post['slide']);
                    }
                }
                else
                    $this->slidesTable->save($this->post['slide']);

                $variables = [
                    'pageName' => $pageName,
                    'slideName' => htmlspecialchars(strip_tags($this->post['slide']['name']), ENT_QUOTES, 'UTF-8')
                ];
            }
            else {
                if (isset($this->get['id'])) {
                    $pageName = 'Edit Slide';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/editslide.html.php';
                }
                else {
                    $pageName = 'Add Slide';
                    $layout = 'adminlayout.html.php';
                    $template = 'pages/admin/editslide.html.php';
                }
                
                $variables = [
                    'pageName' => $pageName,
                    'error' => $error,
                    'slide' => $slide
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

    public function deleteSlide() {
        $imageId = $this->slidesTable->retrieveRecord('slide_id', $this->post['slide']['slide_id'])[0]->image_id;

        $this->slidesTable->deleteRecordById($this->post['slide']['slide_id']);

        if (!empty($imageId))
            $this->imagesTable->deleteRecordById($imageId);

        header('Location: /admin/slides');
    }
}
?>