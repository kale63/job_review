<?php

    use Backend\API\User;
    require_once __DIR__.'/API/User.php';

    $posts = new User('marketzone');
    $posts->login( $_POST['email'], $_POST['password'] );
    echo $posts->getData();
?>