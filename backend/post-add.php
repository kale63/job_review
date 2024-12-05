<?php
    use Backend\API\Create;
    require_once __DIR__.'/API/Create.php';

    $posts = new Create('marketzone');
    //$posts = new Create('job_review');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $posts->add( $jsonOBJ );
    echo $posts->getData();
?>