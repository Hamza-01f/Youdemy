<?php
namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';

use App\Config\Database;
use App\Models\User;
use PDO;

interface StatisticsInterface {
    public function getAllStats($teacherId);
}

class Teacher extends User implements StatisticsInterface {

    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function save(): bool {
        $db = Database::getInstance()->getConnection();
        
        $query = "INSERT INTO users (username, email, password, role, bio, profile_image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            $this->getUsername(),
            $this->getEmail(),
            $this->getPassword(),
            $this->getRole(),
            $this->getBio(),
            $this->getImageUrl()
        ]);
        
     
        if ($this->getRole() == 'teacher') {
            $userId = $db->lastInsertId();  
            $secondQuery = "INSERT INTO asked_users (username, email, user_id, profile_image) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($secondQuery);
            return $stmt->execute([
                $this->getUsername(),
                $this->getEmail(),
                $userId, 
                $this->getImageUrl()
            ]);
        }

        return false;
    }

    public function getAllStats($teacherId) {
        $statistics = [];
        
        $queries = [
            'activeCourses' => "
                SELECT COUNT(*) AS active_courses 
                FROM courses 
                WHERE status = 'active' AND teacher_id = :teacher_id
            ",
            'enrolledStudents' => "
                SELECT COUNT(DISTINCT student_id) AS enrolled_students 
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                WHERE c.teacher_id = :teacher_id
            ",
            'enrollmentTrend' => "
                SELECT DATE(e.enrollment_date) AS date, COUNT(*) AS count
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                WHERE c.teacher_id = :teacher_id
                GROUP BY DATE(e.enrollment_date)
                ORDER BY date ASC
            ",
            'coursePerformance' => "
                SELECT c.title, COUNT(e.student_id) AS students
                FROM courses c
                LEFT JOIN enrollments e ON c.id = e.course_id
                WHERE c.status = 'active' AND c.teacher_id = :teacher_id
                GROUP BY c.id
            "
        ];
        
        foreach ($queries as $key => $query) {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':teacher_id', $teacherId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
            if ($key == 'activeCourses') {
                $statistics[$key] = isset($result[0]['active_courses']) ? $result[0]['active_courses'] : 0;
            } elseif ($key == 'enrolledStudents') {
                $statistics[$key] = isset($result[0]['enrolled_students']) ? $result[0]['enrolled_students'] : 0;
            } elseif ($key == 'enrollmentTrend' || $key == 'coursePerformance') {
                $statistics[$key] = $result;
            }
        }
           
        return $statistics;
    }
}
?>
