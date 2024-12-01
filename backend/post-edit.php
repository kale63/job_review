<?php
    use Backend\API\Update;
    require_once __DIR__.'/API/Update.php';

    $productos = new Update('marketzone');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $productos->edit( $jsonOBJ );
    echo $productos->getData();
?>