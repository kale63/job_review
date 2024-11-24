<?php
namespace Backend\API;

require_once __DIR__ . '../vendor/autoload.php';

class Post extends User {
    private $title;
    private $company;
    private $rating;
    private $description;
    private $bookmark;

    public function __construct($title, $com, $rate, $desc) {
        $this->title = $title;
        $this->company = $com;
        $this->rating = $rate;
        $this->description = $desc;
        $this->bookmark = 0;
    }

    
}