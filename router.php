<?php

require_once __DIR__.'/App/controllers/CourseController.php';
require_once __DIR__.'/App/models/User.php';

use App\Controllers\CourseController;

$courseController = new CourseController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['action']) && $_POST['action'] === 'save_course') {
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $courseImage = $_POST['courseImage'];
        $teacherId = $_POST['author'];  
        $categoryId = $_POST['category_id'];
        $tags = isset($_POST['tags']) ? $_POST['tags'] : []; 
        $contentType = $_POST['content_type']; 
        
        if ($contentType == 'document') {
            $content = $_POST['document'];
            $courseController->saveCourse($title, $description, $content, $courseImage, $teacherId, $categoryId, $tags, $contentType);
           
        } else if ($contentType == 'video') {
            $content = $_POST['content'];
            $courseController->saveCourse($title, $description, $content, $courseImage, $teacherId, $categoryId, $tags, $contentType);
        }
        
        header('Location:/App/views/teacher/AddCourse.php');
        exit();
    }
}
?>
