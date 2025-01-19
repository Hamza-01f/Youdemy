<?php

require_once __DIR__ . '/../controllers/authcontroller.php';

use App\controllers\authcontroller;


if(isset($_POST["submit"]) &&  $_SERVER['REQUEST_METHOD'] == "POST")
{
        $username = $_POST["username"];
        $password = $_POST["password"];
        authcontroller::logIn($username,$password);     
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Welcome Back!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .animated-gradient {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>

<body class="font-poppins">
    <div class="min-h-screen animated-gradient flex items-center justify-center ">
    
        <div class="max-w-md w-full glass-effect rounded-2xl shadow-2xl p-8 floating">
      
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                    Welcome !
                </h2>
                <p class="mt-2 text-gray-600">Please sign in to continue</p>
            </div>

            <form class="space-y-6" method="POST">
        
            
                <div class="relative">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-user"></i>
                        </span>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                   transition-all duration-300"
                            placeholder="Enter your username"
                        />
                    </div>
                </div>

             
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                   transition-all duration-300"
                            placeholder="Enter your password"
                        />
                        <button 
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer"
                        >
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button
                    type="submit"
                    name="submit"
                    class="w-full py-3 px-4 rounded-xl text-white font-semibold
                           bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500
                           hover:opacity-90 transform transition-all duration-300 hover:scale-105
                           focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                >
                    Sign In
                </button>
            </form>

          
            <div class="mt-8 text-center">
                <a href="Register.php" 
                   class="text-purple-600 hover:text-purple-500 transition-colors duration-300 flex items-center justify-center gap-2">
                    <span>Don't have an account?</span>
                    <span class="font-semibold hover:underline">Register here</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <p class="mt-4 text-sm text-gray-500">
                    Your journey with us starts here. Welcome to our community! 🌟
                </p>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
    </script>
</body>
</html>


