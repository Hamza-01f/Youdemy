<?php

require_once __DIR__.'/App/controllers/CourseController.php';

use App\Controllers\CourseController;

$courseController = new CourseController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'save_course') {
        echo'hello';
        $courseController->saveCourse();
    }
}

