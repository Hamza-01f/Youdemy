<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
        }
        .course-progress {
            background: linear-gradient(90deg, #3B82F6 var(--progress), #E5E7EB var(--progress));
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-graduation-cap text-2xl text-blue-600"></i>
                        <span class="text-2xl font-bold text-blue-600">Youdemy</span>
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="Browse.php" class="text-gray-900 hover:text-blue-600">Browse</a>
                        <a href="MesCours.php" class="text-gray-900 hover:text-blue-600">My Courses</a>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search courses..." 
                               class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-600 hover:text-blue-600">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <img src="/api/placeholder/32/32" alt="Profile" class="w-8 h-8 rounded-full">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Course Details -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Course Header -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex items-center space-x-2 text-sm text-blue-600 mb-4">
                        <a href="#">Courses</a>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                        <a href="#">Programming</a>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                        <span>Web Development</span>
                    </div>
                    <h1 class="text-3xl font-bold mb-4">Advanced Full-Stack Web Development</h1>
                    <p class="text-gray-600 mb-6">Master modern web development with this comprehensive course covering frontend, backend, and deployment.</p>
                    <div class="flex items-center space-x-6 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-users text-gray-400 mr-1"></i>
                            <span>12,345 students</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-gray-400 mr-1"></i>
                            <span>42 hours</span>
                        </div>
                    </div>
                </div>

                <!-- Course Content -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4">Course Content</h2>
                    <div class="space-y-4">
                        <!-- Section 1 -->
                        <div class="border rounded-lg">
                            <div class="flex justify-between items-center p-4 cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                    <div>
                                        <h3 class="font-medium">1. Introduction to Web Development</h3>
                                        <p class="text-sm text-gray-500">4 lectures • 45 min</p>
                                    </div>
                                </div>
                                <span class="text-sm text-blue-600">Preview</span>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div class="border rounded-lg">
                            <div class="flex justify-between items-center p-4 cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                    <div>
                                        <h3 class="font-medium">2. HTML & CSS Fundamentals</h3>
                                        <p class="text-sm text-gray-500">8 lectures • 2 hours</p>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500">Locked</span>
                            </div>
                        </div>

                        <!-- Section 3 -->
                        <div class="border rounded-lg">
                            <div class="flex justify-between items-center p-4 cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                    <div>
                                        <h3 class="font-medium">3. JavaScript Essentials</h3>
                                        <p class="text-sm text-gray-500">12 lectures • 3 hours</p>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500">Locked</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instructor -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold mb-4">Your Instructor</h2>
                    <div class="flex items-start space-x-4">
                        <img src="/api/placeholder/80/80" alt="Instructor" class="w-20 h-20 rounded-full">
                        <div>
                            <h3 class="font-bold text-lg mb-2">David Anderson</h3>
                            <p class="text-gray-600 mb-4">Senior Web Developer with 10+ years of experience in full-stack development. Taught over 100,000 students worldwide.</p>
                            <div class="flex space-x-4 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-award text-blue-600 mr-1"></i>
                                    <span>15 Courses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</body>
</html>