<?php
    use Backend\API\Read as Read;
    require_once __DIR__.'/API/Read.php';

    $productos = new Read('marketzone');
    $productos->list();
    echo $productos->getData();
?>