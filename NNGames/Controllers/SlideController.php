<?php
namespace NNGames\Controllers;
class SlideController {
    private $slidesTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $slidesTable, $get, $post) {
        $this->slidesTable = $slidesTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function listSlides() {
        $slidesTable = $this->slidesTable->retrieveAllRecords();

        return [
            'layout' => 'adminlayout.html.php',
            'template' => 'pages/admin/categories.html.php',
            'variables' => [
                'products' => $slides
            ],
            'title' => 'Admin Panel - Slides'
        ];
    }
}
?>