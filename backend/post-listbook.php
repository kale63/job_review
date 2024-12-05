<?php
    use Backend\API\Read as Read;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new Read('marketzone');
    $posts->listBook( $_POST['currentuser'] );
    echo $posts->getData();
?>