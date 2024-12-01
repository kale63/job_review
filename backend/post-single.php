<?php
    use Backend\API\Read;
    require_once __DIR__.'/API/Read.php';

    $productos = new Read('marketzone');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
?>