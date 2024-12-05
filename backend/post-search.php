<?php
    use Backend\API\Read;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new Read('marketzone');
    $posts->search( $_GET['search'] );
    echo $posts->getData();
?>