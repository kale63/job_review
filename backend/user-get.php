<?php
    use Backend\API\User;
    require_once __DIR__.'/API/User.php';

    $posts = new User('marketzone');
    $posts->getProfile( $_POST['userId'] );
    echo $posts->getData();
?> 