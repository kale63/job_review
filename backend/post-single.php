<?php
    use Backend\API\Read;
    require_once __DIR__.'/API/Read.php';

    $posts = new Read('marketzone');
    $posts->single( $_POST['id'] );
    echo $posts->getData();
?>