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
    private $db;


    public function __construct($title, $description, $content,  $imageUrl, $teacherId, $categoryId, $tags = []) {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->imageUrl = $imageUrl;
        $this->teacherId = $teacherId;
        $this->categoryId = $categoryId;
        $this->tags = $tags;
        $this->db = Database::getInstance()->getConnection();

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

    public static function ReadCourse($id){
        $db = Database::getInstance()->getConnection();
        
        $stmt = $db->prepare("
            SELECT courses.id, courses.title, courses.description, courses.content, courses.created_at, courses.image_url, 
                   users.username AS teacher_name, categories.name AS category_name
            FROM courses
            JOIN users ON courses.teacher_id = users.id
            JOIN categories ON courses.category_id = categories.id
            WHERE courses.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $tagsStmt = $db->prepare("
            SELECT tags.name 
            FROM tags 
            JOIN course_tags ON tags.id = course_tags.tag_id 
            WHERE course_tags.course_id = :id
        ");
        $tagsStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $tagsStmt->execute();
        $tags = $tagsStmt->fetchAll(PDO::FETCH_ASSOC);
  
        $course['tags'] = array_map(function($tag) {
            return $tag['name'];
        }, $tags);
        
        return $course;
    }
    

    public static function getAllCourses($id) {
        if($id == 9){
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT courses.id, courses.title, courses.description,courses.content,courses.created_at, courses.image_url, categories.name AS category_name, courses.status , users.profile_image, users.username
                                  FROM courses
                                  Join users on courses.teacher_id = users.id
                                  JOIN categories ON courses.category_id = categories.id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT courses.id, courses.title, courses.description, courses.image_url, categories.name AS category_name, courses.status
                                  FROM courses
                                  JOIN categories ON courses.category_id = categories.id
                                  where courses.teacher_id = :id
                                  ");
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

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
    
    public static function updateCourse($courseId, $title,$content, $description, $categoryId,  $courseImage) {
         $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE courses SET title = :title, description = :description, content = :content, category_id = :category_id, image_url = :image_url WHERE id = :courseId");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':description' => $description,
            ':category_id' => $categoryId,
            ':image_url' => $courseImage,
            ':courseId' => $courseId
        ]);
    }

    public static function updateCourseTags($courseId, $tags) {
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

    public static function getRelatedCourses($id){
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT courses.id, courses.title,courses.created_at ,courses.image_url, courses.description, categories.name AS category_name, courses.status,users.username,users.profile_image
                              FROM courses
                              JOIN categories ON courses.category_id = categories.id
                              Join users on courses.teacher_id = users.id
                              where courses.status = 'active' AND users.id = :id
                              ");
        $stmt->bindParam(':id',$id,\PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE courses SET status = 'pending' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function pending($id){
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE courses SET status = 'active' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function search($id, $role, $searchTerm) {
        $db = Database::getInstance()->getConnection();
        
        if ($role == 'admin') {
            $stmt = $db->prepare("SELECT * FROM courses WHERE title LIKE :searchTerm");
            $stmt->bindParam(':searchTerm', $searchTerm);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else if($role == 'teacher'){
            $stmt = $db->prepare("SELECT * FROM courses where title like :searchTerm and teacher_id = :id");
            $stmt->bindParam(':searchTerm',$searchTerm);
            $stmt->bindParam(':id',$id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

}
