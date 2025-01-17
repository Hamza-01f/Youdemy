<?php
require_once __DIR__.'/vendor/autoload.php';

$courseController = new \App\Controllers\CourseController();

$courses = $courseController->getAllowedCourses();

$coursesPerPage = 3;
$totalCourses = count($courses);
$totalPages = ceil($totalCourses / $coursesPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($page - 1) * $coursesPerPage;
$currentPageCourses = array_slice($courses, $startIndex, $coursesPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Transform Your Future</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .navbar-blur {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .category-pill {
            background: rgba(79, 70, 229, 0.1);
            border: 1px solid rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
        }

        .category-pill:hover {
            background: rgba(79, 70, 229, 0.2);
            transform: translateY(-2px);
        }

        .search-input {
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
   
    <nav class="navbar-blur fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
          
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-2.5 rounded-xl shadow-lg">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold gradient-text">Youdemy</span>
                </div>
                
               
                <div class="hidden md:flex items-center space-x-8">
                    
             
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search courses..." 
                               class="w-64 pl-10 pr-4 py-2 rounded-full border-2 border-gray-200 focus:border-indigo-500 focus:outline-none search-input">
                        <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/App/views/logIn.php" 
                       class="px-6 py-2 text-indigo-600 hover:text-indigo-700 font-medium transition-colors">
                        Sign In
                    </a>
                    <a href="/App/views/Register.php" 
                       class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <div class="hero-bg min-h-[80vh] flex items-center justify-center text-white">
        <div class="max-w-7xl mx-auto px-6 py-32 text-center">
            <h1 class="text-6xl font-bold mb-8 leading-tight">
                Unlock Your Potential<br>
                <span class="text-indigo-400">Master New Skills</span>
            </h1>
            <p class="text-xl mb-12 max-w-2xl mx-auto text-gray-300">
                Join thousands of learners worldwide and transform your future with our expert-led courses.
            </p>
            <div class="flex justify-center space-x-6">
                <a href="/App/views/Register.php" 
                   class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full hover:shadow-xl transition-all duration-300 flex items-center">
                    <i class="fas fa-rocket mr-2"></i>
                    Start Learning
                </a>
                <a href="#courses" 
                   class="px-8 py-3 bg-white/10 rounded-full hover:bg-white/20 transition-all duration-300 backdrop-blur-sm flex items-center">
                    <i class="fas fa-play mr-2"></i>
                    Explore Courses
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20" id="courses">

        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold gradient-text mb-4">Featured Courses</h2>
                <p class="text-gray-600">Explore our most popular learning paths</p>
            </div>
            
            <div class="flex space-x-2">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <button onclick="showPage(<?= $i ?>)" 
                            class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 <?= $i === $page ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' ?>">
                        <?= $i ?>
                    </button>
                <?php endfor; ?>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (count($currentPageCourses) > 0): ?>
                <?php foreach ($currentPageCourses as $course): ?>
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                        <div class="relative">
                            <img src="<?= $course['image_url'] ?>" 
                                 alt="<?= $course['title'] ?>" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="category-pill px-4 py-1.5 rounded-full text-indigo-600 text-sm font-medium">
                                    <?= $course['category_name'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-3 hover:text-indigo-600 transition-colors">
                                <?= $course['title'] ?>
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-2">
                                <?= $course['description'] ?>
                            </p>
           
                            <div class="flex items-center mb-6">
                                <img src="<?= $course['profile_image'] ?>" 
                                     alt="<?= $course['username'] ?>" 
                                     class="w-12 h-12 rounded-full border-2 border-indigo-100">
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900"><?= $course['username'] ?></p>
                                    <p class="text-sm text-gray-500">Course Instructor</p>
                                </div>
                            </div>
           
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <?= date('M d, Y', strtotime($course['created_at'])) ?>
                                </span>
                                <a href="/App/views/logIn.php" 
                                   class="px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors">
                                    Enroll Now
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-16">
                    <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-500">No courses available at the moment.</p>
                    <p class="text-gray-400 mt-2">Please check back later for new courses.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include __DIR__.'/public/footer.php' ?>
    <script>
        function showPage(page) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            window.location.href = url;
        }
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
