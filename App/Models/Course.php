<?php

namespace App\Models;

require_once __DIR__.'/../../vendor/autoload.php';

// require_once __DIR__.'/../Config/db.php';

use  App\Config\Database;

use PDO;

class Course {

    public function saveCourse($title, $description, $content, $courseUrl , $courseImage, $teacherId , $categoryId, $tags) {

        $db = Database::getInstance()->getConnection();

        try {
        
            $db->beginTransaction();

            $stmt = $db->prepare("INSERT INTO courses (title, description, content, content_url, image_url, teacher_id, category_id) VALUES (:title, :description, :content, :content_url, :image_url, :teacher_id, :category_id)");
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':content' => $content,
                ':content_url' => $courseUrl,
                ':image_url' => $courseImage,
                ':teacher_id' => $teacherId,
                ':category_id' => $categoryId
            ]);
            

         
            $courseId = $db->lastInsertId();

           
            if (!empty($tags)) {
                $stmt = $db->prepare("INSERT INTO course_tags (course_id, tag_id) VALUES (:course_id, :tag_id)");
                foreach ($tags as $tagId) {
                    $stmt->execute([
                        ':course_id' => $courseId,
                        ':tag_id' => $tagId,
                    ]);
                }
            }

            $db->commit();
        } catch (PDOException $e) {
            $db->rollBack();
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    public function getAllCourses() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT courses.id, courses.title, courses.description, categories.name AS category_name, courses.status
                              FROM courses
                              JOIN categories ON courses.category_id = categories.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllowedCourses() {
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
    
    public function deleteCourse($courseId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM courses WHERE id = :courseId");
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();
    }
    
    public function updateCourse($courseId, $title,$content, $description, $categoryId, $courseUrl, $courseImage) {
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

    public function getSpecificCourse($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT *                                   
                              FROM courses
                              WHERE courses.id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function active($id){
        $stmt = Database::getInstance()->getConnection()->prepare("UPDATE courses SET status = 'pending' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function pending($id){
        $stmt = Database::getInstance()->getConnection()->prepare("UPDATE courses SET status = 'active' WHERE id = :id");
        $stmt->bindparam(':id', $id , \PDO::PARAM_INT);
        return $stmt->execute();
    }

}
