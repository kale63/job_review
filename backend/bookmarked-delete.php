<?php
    use Backend\API\Delete;
    require_once __DIR__.'/API/Delete.php';

    $posts = new Delete('marketzone');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $posts->deleteBookmark( $jsonOBJ );
    echo $posts->getData();
?>