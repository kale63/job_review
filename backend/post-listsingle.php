<?php
    use Backend\API\Read as Read;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new Read('marketzone');
    $posts->listSingle( $_POST['currentuser'] );
    echo $posts->getData();
?>