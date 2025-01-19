<?php

namespace App\Models;

require_once __DIR__.'/User.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__.'/../Config/Database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config\Database;
use App\Models\User;
use PDO;

Interface InformUser{
   public function sendMail($userEmail,$subject,$body);
}

class Admin extends User implements InformUser {

    private $db ;
    public function __construct(string $username, string $email, string $password, string $role, string $bio, string $imageUrl){
           parent::__construct($username,$email,$password,$role,$bio,$imageUrl);
           $this->db =Database::getInstance()->getConnection(); 
    }


    public function sendMail($userEmail,$subject,$body){

        $mail = new PHPMailer(true);
        try{
          $mail->isSMTP();                                            
          $mail->Host       = 'smtp.gmail.com';                         
          $mail->SMTPAuth   = true;                                   
          $mail->Username   = '';                  
          $mail->Password   = '';                      
          $mail->SMTPSecure = 'ssl';           
          $mail->Port       = 465;
  
          $mail->setFrom('', 'Youdemy Admin');
          $mail->addAddress($userEmail); 
  
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body    = $body;
  
          $mail->send();
        }catch(EXception $se){
          error_log("Mailer Error: {$mail->ErrorInfo}");
        }
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

    public function approveUser($userId) {
        $updateQuery = "UPDATE users SET validation = 'accepted' WHERE id = ?";
        $stmt = $this->db->prepare($updateQuery);
        $stmt->execute([$userId]);
    
        $emailquey = "SELECT email FROM users WHERE id = ?";
        $stmt = $this->db->prepare($emailquey);
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $subject = 'Your Teacher Account Has Been Approved';
            $body = 'Dear ' . $user['email'] . ', ';
            $body .= 'Your request to become a teacher on Youdemy has been approved!';
            $body .= 'Thank you for your patience and we look forward to seeing you teach.';
            $body .= 'Best regards,<br>The Youdemy Team';
    
            $this->sendMail($user['email'], $subject, $body);
        } else {
            error_log("No user found with ID: " . $userId);
        }
    
        $deleteQuery = "DELETE FROM asked_users WHERE user_id = ?";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([$userId]);
    }
    
    public function rejectUser($userId) {
        $deleteQuery = "DELETE FROM asked_users WHERE user_id = ?";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([$userId]);
    
        $emailquey = "SELECT email FROM users WHERE id = ?";
        $stmt = $this->db->prepare($emailquey);
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $subject = 'Your Teacher Account Has Been Rejected';
            $body = 'Dear ' . $user['email'] . ', ';
            $body .= 'We are sorry to inform you that Your request to become a teacher on Youdemy has been rejected!';
            $body .= 'Thank you for your patience and we wish you good luck.';
            $body .= 'Best regards,<br>The Youdemy Team';
    
            $this->sendMail($user['email'], $subject, $body);
        } else {
            error_log("No user found with ID: " . $userId);
        }
    
    }

    public function blockUser($userId) {
      
        $updateQuery = "UPDATE users SET status = 'suspended' WHERE id = ?";
        $stmt = $this->db->prepare($updateQuery);
        $stmt->execute([$userId]);
    }

    public function unblockUser($userId) {
    
        $updateQuery = "UPDATE users SET status = 'active' WHERE id = ?";
        $stmt = $this->db->prepare($updateQuery);
        $stmt->execute([$userId]);
    }

    public function deleteUser($userId) {
      
        $deleteQuery = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->execute([$userId]);

        
    }

    private function adminExists(): bool {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT COUNT(*) FROM users WHERE role = 'admin' AND email = :email";
    
        $stmt = $db->prepare($query);
        $email = $this->getEmail(); 
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR); 
    
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

$admin = new Admin('hamza', '', '000000', 'admin', 'I am the admin of this website', '/public/Images/admin1.jpg');
$admin->save();
?>