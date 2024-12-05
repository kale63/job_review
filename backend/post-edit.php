<?php
    use Backend\API\Update;
    require_once __DIR__.'/API/Update.php';

    $posts = new Update('marketzone');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $posts->edit( $jsonOBJ );
    echo $posts->getData();
?>