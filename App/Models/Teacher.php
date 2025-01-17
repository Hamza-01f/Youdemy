<?php
namespace App\models;

 require_once __DIR__.'/../Config/Database.php';


use App\Config\Database;
use App\models\User;

class Teacher extends User {

    public function save(): bool {
        $db = Database::getInstance()->getConnection();
        $query = "INSERT INTO users (username, email, password, role, bio, profile_image) VALUES (?, ?, ?, ?, ?, ?)";
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
}
?>
