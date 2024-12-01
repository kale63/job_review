<?php
    use Backend\API\Delete;
    require_once __DIR__.'/API/Delete.php';

    $productos = new Delete('marketzone');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $productos->deleteBookmark( $jsonOBJ );
    echo $productos->getData();
?>