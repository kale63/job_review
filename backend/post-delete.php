<?php
    use Backend\API\Delete;
    require_once __DIR__.'/API/Delete.php';

    $posts = new Delete('marketzone');
    $posts->delete( $_POST['id'] );
    echo $posts->getData();
?>