<?php
namespace Backend\API;

require_once __DIR__ . '../vendor/autoload.php';
class User {
    
    private $username;
    private $password;
    private $email;

    public function __construct($user, $pw, $email) {
        $this->username = $user;
        $this->password = $pw;
        $this->email = $email;
    }
}