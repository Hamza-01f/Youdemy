<?php

require_once __DIR__.'/App/controllers/CourseController.php';
require_once __DIR__.'/App/models/User.php';

use App\Controllers\CourseController;

$courseController = new CourseController();
$courseController = new CourseController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'save_course') {
        $courseController->saveCourse();
        header('Location:/App/views/teacher/AddCourse.php');
        exit();
    }

    if ($_GET['action'] === 'addUser') {
        UsersController::addUser();
        
        header('Location: /index.php');
        exit();

    }

}

