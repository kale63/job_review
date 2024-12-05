<?php

    use Backend\API\User;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new User('marketzone');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $posts->signUp( $jsonOBJ );
    echo $posts->getData();
?>