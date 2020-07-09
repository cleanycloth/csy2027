<?php
namespace NNGames\Controllers;
class SlideController {
    private $slidesTable;
    private $get;
    private $post;
    private $files;

    public function __construct(\CSY2028\DatabaseTable $slidesTable, $get, $post, $files) {
        $this->slidesTable = $slidesTable;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
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

            $uploadedFile = $this->files['image']['tmp_name'];

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

                if ($this->files['image']['tmp_name'] != '') {
                    if (isset($this->get['id'])) {
                        move_uploaded_file($this->files['image']['tmp_name'], ltrim($slide->image, '/'));

                        $this->slidesTable->save($this->post['slide']);
                    }
                    else {
                        $parts = explode('.', $this->files['image']['name']);
                        $extension = end($parts);
                        $filePath = '/images/slides/' . uniqid() . '.' . $extension;
                        move_uploaded_file($this->files['image']['tmp_name'], ltrim($filePath, '/'));

                        $this->post['slide']['image'] = $filePath;
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

    // Method for deleting a slide from the database and its image.
    public function deleteSlide() {
        $image = $this->slidesTable->retrieveRecord('slide_id', $this->post['slide']['slide_id'])[0]->image;

        $this->slidesTable->deleteRecordById($this->post['slide']['slide_id']);

        if ($image != '/images/image-slide-placeholder.jpg')
            unlink(ltrim($image, '/'));

        header('Location: /admin/slides');
    }
}
?>