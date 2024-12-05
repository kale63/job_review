<?php
    use Backend\API\Read;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new Read('marketzone');
    $posts->single( $_POST['id'] );
    echo $posts->getData();
?>