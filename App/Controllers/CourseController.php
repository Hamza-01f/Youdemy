<?php

namespace App\Controllers;

require_once __DIR__.'/../Models/Course.php';
require_once __DIR__.'/../Models/Document.php';
require_once __DIR__.'/../Models/Video.php';


use App\Models\Course;
use App\Models\Document;
use App\Models\Video;

class CourseController {



    public function saveCourse($title, $description, $content, $courseImage, $teacherId, $categoryId, $tags, $contentType) {
        $course = null;
    
        if ($contentType == 'document') {
            
            $course = new Document($title, $description, $content, $courseImage, $teacherId, $categoryId, $tags);
           
        } else if ($contentType == 'video') {
         
            $course = new Video($title, $description, $content, $courseImage, $teacherId, $categoryId, $tags);
        }
        
        if ($course) {
            $course->save();
        }
        
    }

    public function getCourses($id) {
        
        return Course::getAllCourses($id);  
    }
    

    public function getAllowedCourses() {

        return Course::getAllowedCourses();
    }

    public function getCourseById($id) {

        return Course::getSpecificCourse($id);
    }
    
    public function deleteCourse($courseId) {
        // $courseModel = new \App\Models\Course();
        Course::deleteCourse($courseId);
    }

    public function getSpecificCourse($id){
        return Course::ReadCourse($id);
    }
    
    public function getRelatedCourses($id){
        return Course::getRelatedCourses($id);
    }

    public function updateCourse($courseId, $title,$content, $description, $categoryId,  $courseImage, $tags) {

        Course::updateCourse($courseId, $title,$content, $description, $categoryId,  $courseImage);
        
        Course::updateCourseTags($courseId, $tags);
    }

    public static function active($id){
        Course::active($id);
    }

    public static function pending($id){
        Course::pending($id);
    }

    public function search($id, $role, $searchTerm = '') {

        $searchTerm = trim($searchTerm);
        $searchTerm = '%' . $searchTerm . '%'; 
    
        $searchResults = Course::search($id, $role, $searchTerm);
        if ($searchResults) {
            return $searchResults;
        } 
    }
}
