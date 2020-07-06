<?php
namespace NNGames\Controllers;
class ImageController {
    private $imagesTable;
    private $get;
    private $post;

    public function __construct(\CSY2028\DatabaseTable $imagesTable, $get, $post) {
        $this->imagesTable = $imagesTable;
        $this->get = $get;
        $this->post = $post;
    }

    // Function for displaying the admin home page.
    public function fetchImage() {
        if ($this->get['id']) {
            $image = $this->imagesTable->retrieveBlob($this->get['id']);

            if (!empty($image['data'])) {
                return [
                    'layout' => 'blanklayout.html.php',
                    'template' => 'pages/main/image.html.php',
                    'variables' => [
                        'mime' => $image['mime'],
                        'data' => $image['data']
                    ],
                    'title' => 'Image'
                ];
            }
            else {
                http_response_code(404);
                header('Location: /404');
            }
        }
        else {
            http_response_code(404);
            header('Location: /404');
        }
    }
}
?>