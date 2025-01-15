<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Transform Your Future</title>
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
                               placeholder="What do you want to learn today?" 
                               class="w-full pl-12 pr-4 py-3 rounded-full border border-gray-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/App/views/logIn.php" class="px-6 py-2.5 text-indigo-600 font-medium hover:bg-indigo-50 rounded-full transition-colors">
                        Log in
                    </a>
                    <a href="/App/views/Register.php" class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-full hover:bg-indigo-700 transition-colors">
                        Join Free
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="gradient-bg pt-32 pb-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-6 leading-tight">Learn Without Limits</h1>
                    <p class="text-xl text-indigo-100 mb-8">Start, switch, or advance your career with more than 5000+ courses from world-class instructors.</p>
                    <div class="flex space-x-4">
                        <button class="px-8 py-4 bg-white text-indigo-600 rounded-full font-semibold hover:bg-indigo-50 transition-colors">
                            Start Learning
                        </button>
                        <button class="px-8 py-4 border-2 border-white text-white rounded-full font-semibold hover:bg-white/10 transition-colors">
                            Try For Free
                        </button>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="/api/placeholder/600/400" alt="Learning Illustration" class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Strip -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-video text-2xl text-indigo-600"></i>
                    <span class="font-medium">5000+ Courses</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-users text-2xl text-indigo-600"></i>
                    <span class="font-medium">Expert Teachers</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-infinity text-2xl text-indigo-600"></i>
                    <span class="font-medium">Lifetime Access</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-certificate text-2xl text-indigo-600"></i>
                    <span class="font-medium">Certification</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Section - Page 1 -->
    <div class="max-w-7xl mx-auto px-4 py-16" id="page-1">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">Featured Courses</h2>
            <div class="flex space-x-2">
                <span onclick="showPage(1)" class="w-10 h-10 flex items-center justify-center rounded-full pagination-active cursor-pointer">1</span>
                <span onclick="showPage(2)" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:border-indigo-600 cursor-pointer">2</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <img src="https://www.nullplex.com/uploads/blogs/coverimages/fad4b53c-9630-48ab-bcbf-2a9b3c536119-20240130071903.png" alt="UI/UX Course" class="w-full object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold">UI/UX Design Mastery</h3>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm font-medium">Design</span>
                    </div>
                    <p class="text-gray-600 mb-4">Master modern UI/UX design principles and tools</p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-clock mr-2"></i>
                        <span>12 weeks • 36 lessons</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-sm font-medium">Sarah Wilson</span>
                        </div>
                        <span class="text-2xl font-bold text-indigo-600">$89</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <img src="/public/Images/full stack.jpg" alt="Web Development" class="w-full object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold">Full-Stack Web Development</h3>
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">Coding</span>
                    </div>
                    <p class="text-gray-600 mb-4">Build modern web applications from scratch</p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-clock mr-2"></i>
                        <span>16 weeks • 48 lessons</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-sm font-medium">David Chen</span>
                        </div>
                        <span class="text-2xl font-bold text-indigo-600">$129</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <img src="/public/Images/digital.jpg" alt="Digital Marketing" class="w-full object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold">Digital Marketing Pro</h3>
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-medium">Marketing</span>
                    </div>
                    <p class="text-gray-600 mb-4">Master digital marketing strategies</p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-clock mr-2"></i>
                        <span>10 weeks • 30 lessons</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-sm font-medium">Emily Parker</span>
                        </div>
                        <span class="text-2xl font-bold text-indigo-600">$99</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Section - Page 2 (Initially Hidden) -->
    <div class="max-w-7xl mx-auto px-4 py-16 hidden" id="page-2">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 4 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <img src="/api/placeholder/400/200" alt="Data Science" class="w-full object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold">Data Science Fundamentals</h3>
                        <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm font-medium">Data</span>
                    </div>
                    <p class="text-gray-600 mb-4">Learn data analysis and visualization</p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-clock mr-2"></i>
                        <span>14 weeks • 42 lessons</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-sm font-medium">Alex Johnson</span>
                        </div>
                        <span class="text-2xl font-bold text-indigo-600">$149</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 5 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <img src="/api/placeholder/400/200" alt="Mobile Development" class="w-full object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold">Mobile App Development</h3>
                        <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-medium">Mobile</span>
                    </div>
                    <p class="text-gray-600 mb-4">Create iOS and Android applications</p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-clock mr-2"></i>
                        <span>15 weeks • 45 lessons</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-sm font-medium">Michael Zhang</span>
                        </div>
                        <span class="text-2xl font-bold text-indigo-600">$139</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 6 -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <img src="/api/placeholder/400/200" alt="AI Course" class="w-full object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold">AI & Machine Learning</h3>
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm font-medium">AI</span>
                    </div>
                    <p class="text-gray-600 mb-4">Explore artificial intelligence concepts</p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-clock mr-2"></i>
                        <span>18 weeks • 54 lessons</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-sm font-medium">Robert Kim</span>
                        </div>
                        <span class="text-2xl font-bold text-indigo-600">$199</span>
                    </div>
                </div>
            </div> 
       </div> 
    </div>  

    <script>
        function showPage(page) {
            const page1 = document.getElementById('page-1');
            const page2 = document.getElementById('page-2');
            const paginationItems = document.querySelectorAll('.pagination-active');
            
            if (page === 1) {
                page1.classList.remove('hidden');
                page2.classList.add('hidden');
                // Remove the 'pagination-active' class from all pagination items
                document.querySelectorAll('.pagination-active').forEach(item => item.classList.remove('pagination-active'));
                // Add the 'pagination-active' class to the first page
                document.querySelectorAll('.pagination-active')[0].classList.add('pagination-active');
            } else {
                page2.classList.remove('hidden');
                page1.classList.add('hidden');
                // Remove the 'pagination-active' class from all pagination items
                document.querySelectorAll('.pagination-active').forEach(item => item.classList.remove('pagination-active'));
                // Add the 'pagination-active' class to the second page
                document.querySelectorAll('.pagination-active')[1].classList.add('pagination-active');
            }
        }
    </script>

</body>
</html>
