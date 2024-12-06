<?php
    use Backend\API\User;
    require_once __DIR__.'/vendor/autoload.php';

    $posts = new User('marketzone');
    $posts->verifyUE( 'username', $_GET['verify'] );
    echo $posts->getData();
?>