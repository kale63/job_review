<?php
    use Backend\API\Read;
    require_once __DIR__.'/API/Read.php';

    $posts = new Read('marketzone');
    $posts->search( $_GET['search'] );
    echo $posts->getData();
?>