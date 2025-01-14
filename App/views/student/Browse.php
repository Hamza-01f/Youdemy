<?php


require_once __DIR__.'/../../controllers/CategoryController.php';

$courseController = new \App\Controllers\CourseController();

$courses = $courseController->getAllowedCourses();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Student Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }
        .card-hover {
            transition: transform 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
        }
        .pagination-active {
            background: #4F46E5;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-2">
                    <div class="gradient-bg p-2 rounded-lg">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Youdemy</span>
                </div>

                <div class="hidden md:flex flex-1 justify-center max-w-2xl mx-8">
                    <div class="relative w-full">
                        <input type="text" 
                               placeholder="Search for courses..." 
                               class="w-full pl-12 pr-4 py-3 rounded-full border border-gray-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <button class="relative">
                        <i class="fas fa-bell text-xl text-gray-600"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                    </button>
                    <div class="flex items-center space-x-3">
                        <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-indigo-200">
                        <div class="hidden md:block">
                            <p class="font-medium text-gray-900">John Doe</p>
                            <p class="text-sm text-gray-500">Student</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <div class="gradient-bg pt-32 pb-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-4">Welcome back, John!</h1>
                    <p class="text-xl text-indigo-100">Ready to continue your learning journey?</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="#courses" class="px-8 py-4 bg-white text-indigo-600 rounded-full font-semibold hover:bg-indigo-50 transition-colors">
                        Browse Courses
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Section -->
    <div class="max-w-7xl mx-auto px-4 py-16" id="courses">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">Available Courses</h2>
            <div class="flex space-x-2">
                <span onclick="showPage(1)" class="w-10 h-10 flex items-center justify-center rounded-full pagination-active cursor-pointer">1</span>
                <span onclick="showPage(2)" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:border-indigo-600 cursor-pointer">2</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="page-1">
            <?php

            if (count($courses) > 0) {
                foreach ($courses as $course) {
                    echo '
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                            <img src="'.$course['image_url'].'" alt="'.$course['title'].'" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm font-medium">'.$course['category_name'].'</span>
                                <p class="text-gray-600 mt-4">'.$course['description'].'</p>
                                <div class="flex items-center mt-4 mb-6">
                                    <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                    <span class="ml-2 text-sm font-medium">Instructor Name</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Created: '.date('M d, Y').'</span>
                                    <form method="POST" action="your_php_logic.php">
                                        <input type="hidden" name="course_id" value="'.$course['id'].'">
                                        <button type="submit" name="enroll" class="px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors">
                                            Enroll Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "No courses available.";
            }
            ?>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 hidden" id="page-2"></div>
    </div>

    <script>
        function showPage(page) {
            const page1 = document.getElementById('page-1');
            const page2 = document.getElementById('page-2');
            const paginationButtons = document.querySelectorAll('[onclick^="showPage"]');
            
            paginationButtons.forEach((button, index) => {
                if (index + 1 === page) {
                    button.classList.add('pagination-active');
                } else {
                    button.classList.remove('pagination-active');
                }
            });

            if (page === 1) {
                page1.classList.remove('hidden');
                page2.classList.add('hidden');
            } else {
                page2.classList.remove('hidden');
                page1.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
