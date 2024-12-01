<?php
    use Backend\API\Create;
    require_once __DIR__.'/API/Create.php';

    $productos = new Create('marketzone');
    //$productos = new Create('job_review');
    $post = file_get_contents('php://input');
    $jsonOBJ = json_decode($post);
    $productos->add( $jsonOBJ );
    echo $productos->getData();
?>