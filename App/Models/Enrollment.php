<?php

namespace App\Models;

require_once __DIR__.'/../Config/Database.php';

use App\Config\Database;

class Enrollment {

    public function createEnrollment($studentId, $courseId) {
        
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM enrollments WHERE student_id = :student_id AND course_id = :course_id");
        $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId,
        ]);

        if ($stmt->rowCount() == 0) {
            $stmt = $db->prepare("INSERT INTO enrollments (student_id, course_id) VALUES (:student_id, :course_id)");
            $stmt->execute([
                ':student_id' => $studentId,
                ':course_id' => $courseId,
            ]);
        }
    }


    public function InformStudent(){
        
    }

    public function isEnrolled($studentId, $courseId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM enrollments WHERE student_id = :student_id AND course_id = :course_id");
        $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId,
        ]);

        return $stmt->rowCount() > 0; 
    }

    public function getEnrolledCourses($studentId, $limit, $offset) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT c.* FROM courses c
                              JOIN enrollments e ON c.id = e.course_id
                              WHERE e.student_id = :student_id AND e.status = 'active'
                              LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':student_id', $studentId, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(); 
    }

  
    public function getEnrolledCoursesCount($studentId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM enrollments WHERE student_id = :student_id AND status = 'active'");
        $stmt->execute([
            ':student_id' => $studentId,
        ]);

        return $stmt->fetchColumn();
    }

    public function getNonEnrolledCourses($studentId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM courses WHERE id NOT IN (
                              SELECT course_id FROM enrollments WHERE student_id = :student_id)");
        $stmt->execute([
            ':student_id' => $studentId,
        ]);
        
        return $stmt->fetchAll();
    }
}
