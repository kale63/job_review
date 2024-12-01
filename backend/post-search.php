<?php
    use Backend\API\Read;
    require_once __DIR__.'/API/Read.php';

    $productos = new Read('marketzone');
    $productos->search( $_GET['search'] );
    echo $productos->getData();
?>