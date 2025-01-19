<?php

namespace App\Models;

require_once __DIR__.'/User.php';

require_once __DIR__.'/../Config/Database.php';


use App\Config\Database;
use App\Models\User;
use PDO;

class Admin extends User {

    private $db ;
    public function __construct(string $username, string $email, string $password, string $role, string $bio, string $imageUrl){
           parent::__construct($username,$email,$password,$role,$bio,$imageUrl);
           $this->db =Database::getInstance()->getConnection(); 
    }

    public function save(): bool{
        $db = Database::getInstance()->getConnection();

        if ($this->adminExists()) {
            return false;
        }

        $query = "INSERT INTO users (username, email, password, role, bio, profile_image) VALUES (?,?,?,?,?,?)";

        $stmt = $db->prepare($query);

        return $stmt->execute([
            $this->getUsername(),
            $this->getEmail(),
            $this->getPassword(),
            $this->getRole(),
            $this->getBio(),
            $this->getImageUrl()
        ]);
    }

    private function adminExists(): bool {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT COUNT(*) FROM users WHERE role = 'admin' AND email = :email";
    
        $stmt = $db->prepare($query);
        $email = $this->getEmail(); // Assign to a variable
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR); // Pass the variable
    
        $stmt->execute();
        $result = $stmt->fetchColumn();
        
        return $result > 0;  
    }

    public function getGeneralStats() {
        $query = "
            SELECT
                (SELECT COUNT(*) FROM users WHERE role = 'teacher' AND status = 'active') AS total_teachers,
                (SELECT COUNT(*) FROM users WHERE role = 'student' AND status = 'active') AS total_students,
                (SELECT COUNT(*) FROM courses WHERE status = 'active') AS active_courses,
                (SELECT COUNT(*) FROM courses WHERE status = 'pending') AS pending_courses,
                (SELECT COUNT(*) FROM categories) AS total_categories
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}

$admin = new Admin('hamza', 'hamza.boumanjel@gmail.com', '000000', 'admin', 'I am the admin of this website', '/public/Images/admin1.jpg');
$admin->save();
?>