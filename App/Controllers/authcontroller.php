<?php

namespace App\Controllers;

require_once __DIR__ . '/../Models/User.php';

use App\models\User;

class authcontroller{
   
    public static function logIn($username, $password) {
       
        $user = User::finduser($username, $password);
        if($user['role'] == 'admin'){
            session_start();
            $_SESSION['user'] = $user;
            header('Location: /App/views/Admin/statistics.php');
            exit();
        }
        if(password_verify($password, $user['password'])) {
           
            if ($user['role'] == 'teacher' && $user['status'] == 'active' && $user['validation'] == 'accepted') {
                session_start();
                $_SESSION['user'] = $user; 
                header('Location: /App/views/teacher/ManageCourses.php');
                exit();
            } else if ($user['role'] == 'student' && $user['status'] == 'active') {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /App/views/student/Browse.php');
                exit();          
            } else { 
                if($user['role'] == 'teacher' && $user['validation'] == 'notaccepted'){
                    session_start();
                    $_SESSION['user'] = $user;
                    header('Location: /App/views/teacher/waitingForValidation.php');
                    exit();
                }else{
                    session_start();
                    $_SESSION['user'] = $user;
                    header('Location: /App/views/Banned.php');
                    exit();
                }
            }
        }else{
          echo 'invalid password or username';
        }
    }


}
