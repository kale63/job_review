<?php
    use Backend\API\User;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new User('marketzone');
    $posts->verifyUE( 'email', $_GET['verify'] );
    echo $posts->getData();
?>