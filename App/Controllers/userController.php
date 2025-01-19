<?php

require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Student.php';
require_once __DIR__.'/../models/Teacher.php';

use App\models\Student;
use App\models\Teacher;
use App\models\User;

session_start(); 

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
}

$user = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = $_POST['password'];  // Password doesn't need htmlspecialchars
        $bio = htmlspecialchars($_POST['bio'], ENT_QUOTES, 'UTF-8');
        $imageUrl = htmlspecialchars($_POST['photo'], ENT_QUOTES, 'UTF-8');
        $role = $_POST['role'];

        if ($role === 'student') {
            $user = new Student($username, $email, $password, $role, $bio, $imageUrl);
        } elseif ($role === 'teacher') {
            $user = new Teacher($username, $email, $password, $role, $bio, $imageUrl);
        }

        if ($user instanceof User) {
            $user->setPassword($password); // Password should be hashed before saving
            if ($user->save()) {
                if($role == 'student'){
                    header('Location: /App/views/logIn.php');
                }
            }
        } else {
            echo "Invalid user role selected.";
        }
    } else {
        // Invalid CSRF token
        echo "Invalid CSRF token.";
    }
}
?>