<?php

namespace App\Controllers;

require_once __DIR__ . '/../models/authontification.php';

use App\models\authontification;

class authcontroller{
   
    public static function logIn($username, $password) {
       
        $user = authontification::finduser($username, $password);
        if(password_verify($password, $user['password'])) {
           
            if ($user['role'] == 'teacher' && $user['status'] == 'active' && $user['validation'] == 'notaccepted') {
                session_start();
                $_SESSION['user'] = $user; 
                header('Location: /App/views/teacher/ManageCourses.php');
                exit();
            } else if ($user['role'] == 'student' && $user['status'] == 'active') {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /App/views/student/Browse.php');
                exit();          
            } else if ($user['role'] == 'admin') {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /App/views/Admin/accountValida.php');
                exit();
            } else { 
                if($user['validation'] == 'accepted'){
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
