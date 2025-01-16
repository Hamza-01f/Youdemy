<?php

namespace App\Controllers;

// require_once __DIR__.'/../models/Course.php';


use App\Models\Course;

class CourseController {

    public function saveCourse() {

        $title = $_POST['title'] ;
        $content = $_POST['content'] ;
        $description = $_POST['description'] ;
        $categoryId = $_POST['category_id'] ;
        $tags = $_POST['tags'] ?? [];
        $courseUrl = $_POST['courseUrl'] ;
        $courseImage = $_POST['courseImage'] ;
        $coursId = $_POST['author'] ;
      
        $errors = [];

        if (empty($title)) {
            $errors[] = 'Course title is required';
        }

        if (empty($description)) {
            $errors[] = 'Course description is required';
        }

        if (empty($categoryId)) {
            $errors[] = 'Category is required';
        }

        if (empty($tags)) {
            $errors[] = 'At least one tag is required';
        }

        if (empty($courseUrl)) {
            $errors[] = 'Course URL is required';
        }

        if (empty($courseImage)) {
            $errors[] = 'Course image URL is required';
        }


        $courseModel = new Course();
        $courseModel->saveCourse($title, $description, $content, $courseUrl , $courseImage, $coursId , $categoryId, $tags);
        

    }

    public function getCourses() {
        $courseModel = new \App\Models\Course();
        return $courseModel->getAllCourses();
    }

    public function getAllowedCourses() {
        $courseModel = new \App\Models\Course();
        return $courseModel->getAllowedCourses();
    }

    public function getCourseById($id) {
        $courseModel = new \App\Models\Course();
        return $courseModel->getSpecificCourse($id);
    }
    
    public function deleteCourse($courseId) {
        $courseModel = new \App\Models\Course();
        $courseModel->deleteCourse($courseId);
    }
    

    public function updateCourse($courseId, $title,$content, $description, $categoryId, $courseUrl, $courseImage, $tags) {
        $courseModel = new Course();

        $courseModel->updateCourse($courseId, $title,$content, $description, $categoryId, $courseUrl, $courseImage);
        
        $courseModel->updateCourseTags($courseId, $tags);
    }

    public static function active($id){
        Course::active($id);
    }

    public static function pending($id){
        Course::pending($id);
    }
}
