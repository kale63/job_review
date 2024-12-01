<?php
    use Backend\API\Read as Read;
    require_once __DIR__.'/API/Read.php';

    $productos = new Read('marketzone');
    $productos->listBook( $_POST['currentuser'] );
    echo $productos->getData();
?>