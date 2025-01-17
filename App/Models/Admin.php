<?php

namespace App\Models;

require_once __DIR__.'/User.php';

require_once __DIR__.'/../Config/Database.php';


use App\Config\Database;
use App\Models\User;

class Admin extends User {

     public function __construct(string $username, string $email, string $password, string $role, string $bio, string $imageUrl){
           parent::__construct($username,$email,$password,$role,$bio,$imageUrl);
     }

     public function save(): bool{
        $db = Database::getInstance()->getConnection();
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
    
}

$admin = new Admin('hamza','hamza.boumanjel@gmail.com','000000','admin','i am the admin of this website','/public/Images/admin1.jpg');
$admin->save();

?>