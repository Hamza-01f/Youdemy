<?php

namespace App\Models;



use App\Models\Course;

class Document extends Course {
   
    public function __construct($title, $description, $content, $imageUrl, $teacherId, $categoryId, $tags = []) {

        parent::__construct($title, $description, $content, $imageUrl, $teacherId, $categoryId, $tags);
    }

    public function save() {
        
        parent::save();
    }
}
