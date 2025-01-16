<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
        }
        .progress-bar {
            background: linear-gradient(90deg, #3B82F6 var(--progress), #E5E7EB var(--progress));
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="gradient-bg p-2 rounded-lg">
                    <i class="fas fa-graduation-cap text-2xl text-white"></i>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Youdemy</span>
            </div>
            <a href="Browse.php" class="text-gray-900 hover:text-blue-600">Browse</a>
            <div class="flex items-center space-x-4">
                <a href="/../LogOut.php" class="px-6 py-2.5 text-indigo-600 font-medium hover:bg-indigo-50 rounded-full transition-colors">
                    Log out
                </a>
            </div>
        </div>
    </nav>

    <div class="gradient-bg text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold mb-4">My Learning Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white/10 rounded-xl p-6">
                    <h3 class="text-lg mb-2">Active Courses</h3>
                    <div class="text-3xl font-bold">4</div>
                </div>
                <div class="bg-white/10 rounded-xl p-6">
                    <h3 class="text-lg mb-2">Hours Learned</h3>
                    <div class="text-3xl font-bold">28.5</div>
                </div>
                <div class="bg-white/10 rounded-xl p-6">
                    <h3 class="text-lg mb-2">Certificates Earned</h3>
                    <div class="text-3xl font-bold">2</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Continue Learning Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Continue Learning</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="/api/placeholder/400/200" alt="Course" class="w-full h-48 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 h-1 progress-bar" style="--progress: 65%"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Advanced Web Development</h3>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>65% complete</span>
                            <span>12/20 lessons</span>
                        </div>
                        <button class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Continue Learning
                        </button>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="/api/placeholder/400/200" alt="Course" class="w-full h-48 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 h-1 progress-bar" style="--progress: 30%"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">UI/UX Design Fundamentals</h3>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>30% complete</span>
                            <span>6/20 lessons</span>
                        </div>
                        <button class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Continue Learning
                        </button>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="/api/placeholder/400/200" alt="Course" class="w-full h-48 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 h-1 progress-bar" style="--progress: 90%"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Data Science Mastery</h3>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>90% complete</span>
                            <span>18/20 lessons</span>
                        </div>
                        <button class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Continue Learning
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Courses Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">My Courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Enrolled Course Card 1 -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Machine Learning Basics</h3>
                        <p class="text-gray-600 mb-4">Learn the fundamentals of machine learning.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>5/10 lessons</span>
                            <span>50% complete</span>
                        </div>
                        <button class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Resume Course
                        </button>
                    </div>
                </div>

                <!-- Enrolled Course Card 2 -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Digital Marketing Essentials</h3>
                        <p class="text-gray-600 mb-4">Get a strong foundation in digital marketing.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>8/10 lessons</span>
                            <span>80% complete</span>
                        </div>
                        <button class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Resume Course
                        </button>
                    </div>
                </div>

                <!-- Enrolled Course Card 3 -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Web Development Bootcamp</h3>
                        <p class="text-gray-600 mb-4">Become a full-stack web developer.</p>
                        <div class="flex justify-between text-sm text-gray-600 mb-4">
                            <span>12/12 lessons</span>
                            <span>Completed</span>
                        </div>
                        <button class="w-full py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            View Certificate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>
