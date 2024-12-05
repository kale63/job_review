<?php
    use Backend\API\User;
    require_once __DIR__.'/API/User.php';

    $productos = new User('marketzone');
    $productos->getProfile( $_POST['userId'] );
    echo $productos->getData();
?> 