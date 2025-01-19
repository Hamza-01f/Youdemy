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
    <link rel="stylesheet" href="/../../public/style.css">
</head>

<body class="font-poppins">
    <!-- Navigation Bar -->
    <nav class="navbar-blur fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo and Brand -->
                <a href="../index.php" class="flex items-center space-x-4 group">
                    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 p-2.5 rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-graduation-cap text-2xl text-white logo-spin"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                        Youdemy
                    </span>
                </a>

                <!-- Home Button -->
                <a href="/../../index.php" class="flex items-center space-x-2 px-6 py-2.5 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-500 hover:to-blue-500 hover:text-white transition-all duration-300 group">
                    <i class="fas fa-home text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Home</span>
                </a>
                <a href="Register.php" class="flex items-center space-x-2 px-6 py-2.5 rounded-xl text-gray-700 hover:bg-gradient-to-r hover:from-purple-600 hover:via-pink-500 hover:to-blue-500 hover:text-white transition-all duration-300 group">
                <i class="fas fa-user-plus text-lg group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Register</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen animated-gradient flex items-center justify-center pt-20">
        <div class="max-w-md w-full glass-effect rounded-2xl shadow-2xl p-8 floating mx-4">
            <!-- Login Form Content -->
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                    Welcome Back!
                </h2>
                <p class="mt-2 text-gray-600">Sign in to continue your learning journey</p>
            </div>

            <form class="space-y-6" method="POST">
                <div class="relative">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 group-hover:text-purple-500 transition-colors">
                            <i class="fas fa-user"></i>
                        </span>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                   hover:border-purple-300 transition-all duration-300"
                            placeholder="Enter your username"
                        />
                    </div>
                </div>

                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 group-hover:text-purple-500 transition-colors">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500
                                   hover:border-purple-300 transition-all duration-300"
                            placeholder="Enter your password"
                        />
                        <button 
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-purple-500 cursor-pointer transition-colors"
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
                           focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2
                           shadow-lg hover:shadow-xl"
                >
                    <span class="flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="Register.php" 
                   class="text-purple-600 hover:text-purple-500 transition-colors duration-300 flex items-center justify-center gap-2 group">
                    <span>Don't have an account?</span>
                    <span class="font-semibold group-hover:underline">Register here</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <p class="mt-4 text-sm text-gray-500">
                    Your journey with us starts here. Welcome to our community! ✨
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
    </script>
</body>
</html>


