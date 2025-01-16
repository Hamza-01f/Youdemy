<?php

namespace App\Models;

require_once __DIR__.'/../Config/Database.php';

use  App\Config\Database;

use PDO;

class Course {


    protected $title;
    protected $description;
    protected $content;
    protected $imageUrl;
    protected $teacherId;
    protected $categoryId;
    protected $tags = [];


    public function __construct($title, $description, $content,  $imageUrl, $teacherId, $categoryId, $tags = []) {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->imageUrl = $imageUrl;
        $this->teacherId = $teacherId;
        $this->categoryId = $categoryId;
        $this->tags = $tags;

    }

    public function save() {
         $db = Database::getInstance()->getConnection();
        try {

            $stmt = $db->prepare("INSERT INTO courses (title, description, content,  image_url, teacher_id, category_id) 
                                  VALUES (:title, :description, :content,  :image_url, :teacher_id, :category_id)");
            $stmt->execute([
                ':title' => $this->title,
                ':description' => $this->description,
                ':content' => $this->content,   
                ':image_url' => $this->imageUrl,
                ':teacher_id' => $this->teacherId,
                ':category_id' => $this->categoryId
            ]);

            $courseId = $db->lastInsertId();

           
            if (!empty($this->tags)) {
                $stmt = $db->prepare("INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)");
                foreach ($this->tags as $tagId) {
                    $stmt->execute([
                        ':course_id' => $courseId,
                        ':tag_id' => $tagId,
                    ]);
                }
            }

        } catch (PDOException $e) {
          
            echo "Error: " . $e->getMessage();
            exit();
        }
    }


    public static function getAllCourses() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT courses.id, courses.title, courses.description, categories.name AS category_name, courses.status
                              FROM courses
                              JOIN categories ON courses.category_id = categories.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllowedCourses() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT courses.id, courses.title,courses.created_at ,courses.image_url, courses.description, categories.name AS category_name, courses.status,users.username,users.profile_image
                              FROM courses
                              JOIN categories ON courses.category_id = categories.id
                              Join users on courses.teacher_id = users.id
                              where courses.status = 'active'
                              ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function deleteCourse($courseId) {
         $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM courses WHERE id = :courseId");
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();
    }
    
    public static function updateCourse($courseId, $title,$content, $description, $categoryId, $courseUrl, $courseImage) {
         $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE courses SET title = :title, description = :description, content = :description, category_id = :category_id, content_url = :content_url, image_url = :image_url WHERE id = :courseId");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':description' => $description,
            ':category_id' => $categoryId,
            ':content_url' => $courseUrl,
            ':image_url' => $courseImage,
            ':courseId' => $courseId
        ]);
    }

    public function updateCourseTags($courseId, $tags) {
         $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("DELETE FROM course_tags WHERE course_id = :course_id");
        $stmt->execute([':course_id' => $courseId]);

        if (!empty($tags)) {
            $stmt = $db->prepare("INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)");
            foreach ($tags as $tagId) {
                $stmt->execute([
                    ':course_id' => $courseId,
                    ':tag_id' => $tagId,
                ]);
            }
        }
    }

    public static function getSpecificCourse($id) {
         $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT *                                   
                              FROM courses
                              WHERE courses.id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function active($id){
        $stmt = $db->prepare("UPDATE courses SET status = 'pending' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function pending($id){
        $stmt = $db->prepare("UPDATE courses SET status = 'active' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }

}
