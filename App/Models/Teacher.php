<?php
namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';

use App\Config\Database;
use App\Models\User;

class Teacher extends User {

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
}
?>
