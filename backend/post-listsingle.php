<?php
    use Backend\API\Read as Read;
    require_once __DIR__.'/API/Read.php';

    $posts = new Read('marketzone');
    $posts->listSingle( $_POST['currentuser'] );
    echo $posts->getData();
?>