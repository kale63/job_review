<?php
    use Backend\API\Create;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new Create('marketzone');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $posts->addBookmark( $jsonOBJ );
    echo $posts->getData();
?>