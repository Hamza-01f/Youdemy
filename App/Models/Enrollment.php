<?php

namespace App\Models;

// require_once __DIR__.'/../Config/db.php';

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

    public function isEnrolled($studentId, $courseId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM enrollments WHERE student_id = :student_id AND course_id = :course_id");
        $stmt->execute([
            ':student_id' => $studentId,
            ':course_id' => $courseId,
        ]);

        return $stmt->rowCount() > 0; 
    }
}

