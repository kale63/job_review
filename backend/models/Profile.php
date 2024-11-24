<?php
namespace Backend\API;

require_once __DIR__ . '../vendor/autoload.php';

class Profile extends User {
    private $image;
    private $bio;

    public function __construct($img, $bio) {
        $this->image = $img;
        $this->bio = $bio;
    }
}