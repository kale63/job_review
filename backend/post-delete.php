<?php
    use Backend\API\Delete;
    require_once __DIR__.'/API/Delete.php';

    $productos = new Delete('marketzone');
    $productos->delete( $_POST['id'] );
    echo $productos->getData();
?>