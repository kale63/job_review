<?php
    use Backend\API\Create;
    require_once __DIR__.'/API/Create.php';

    $productos = new Create('marketzone');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $productos->addBookmark( $jsonOBJ );
    echo $productos->getData();
?>