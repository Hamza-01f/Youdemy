<?php
require_once '../../../vendor/autoload.php';
session_start();

$Studentid = $_SESSION['user']['id'];



$courseController = new \App\Controllers\CourseController();
$enrolling = new App\Controllers\EnrollmentController();

$courses = $courseController->getAllowedCourses();

if (isset($_GET['enrollid']) && $_GET['action'] === 'enroll') {
    $enrollId = $_GET['enrollid'];
    $enrolling->enrollStudent($Studentid,$enrollId);
}

if(isset($_GET['readid']) && $_GET['action'] === 'read'){
    $ReadId = $_GET['readid']; 
}
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.1);
        }
        .pagination-active {
            background: #4F46E5;
            color: white;
        }
        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #4F46E5;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
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

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="MesCours.php" class="nav-link text-gray-600 hover:text-indigo-600 font-medium">My Courses</a>
                    <div class="relative w-64">
                        <input type="text" 
                               placeholder="Search courses..." 
                               class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <button class="relative">
                        <i class="fas fa-bell text-xl text-gray-600 hover:text-indigo-600 transition-colors"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                    </button>
                    <div class="flex items-center space-x-3">
                        <img src="<?php echo $_SESSION['user']['profile_image']; ?>" alt="Profile" class="w-10 h-10 rounded-full border-2 border-indigo-200">
                        <div class="hidden md:block">
                            <p class="font-medium text-gray-900"><?php echo $_SESSION['user']['username']; ?></p>
                            <p class="text-sm text-gray-500">Student</p>
                        </div>
                        <a href="logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Welcome Section with enhanced styling -->
    <div class="gradient-bg pt-32 pb-20 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-4">Welcome back, <?php echo $_SESSION['user']['username']; ?>!</h1>
                    <p class="text-xl text-indigo-100">Ready to continue your learning journey?</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="#courses" class="px-8 py-4 bg-white text-indigo-600 rounded-full font-semibold hover:bg-indigo-50 transition-colors shadow-lg hover:shadow-xl">
                        Browse Courses
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Section with enhanced styling -->
    <div class="max-w-7xl mx-auto px-4 py-16" id="courses">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Available Courses
            </h2>
            <div class="flex space-x-2">
                <span onclick="showPage(1)" class="w-10 h-10 flex items-center justify-center rounded-full pagination-active cursor-pointer transition-colors">1</span>
                <span onclick="showPage(2)" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:border-indigo-600 cursor-pointer transition-colors">2</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="page-1">
            <?php
            if (count($courses) > 0) {
                foreach ($courses as $course) {
                    $isEnrolled = $enrolling->checkEnrollment($Studentid, $course['id']);
                    echo '
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                            <div class="relative">
                                <img src="'.$course['image_url'].'" alt="'.$course['title'].'" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-indigo-600 rounded-full text-sm font-medium shadow-md">
                                        '.$course['category_name'].'
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">'.$course['title'].'</h3>
                                <p class="text-gray-600 mb-4">'.$course['description'].'</p>
                                <div class="flex items-center mb-6">
                                    <img src="'.$course['profile_image'].'" alt="Instructor" class="w-10 h-10 rounded-full border-2 border-indigo-100">
                                    <div class="ml-3">
                                        <p class="font-medium">'.$course['username'].'</p>
                                        <p class="text-sm text-gray-500">Instructor</p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Created: '.date('M d, Y', strtotime($course['created_at'])).'</span>';
                                    
                                    if ($isEnrolled) {
                                        echo '<a href="readCourse.php?readid='.$course['id'].'&action=read" class="px-6 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors shadow-md hover:shadow-lg">
                                                <i class="fas fa-book-reader mr-2"></i>Read
                                            </a>';
                                    } else {
                                        echo '<a href="?enrollid='.$course['id'].'&action=enroll" class="px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors shadow-md hover:shadow-lg">
                                                <i class="fas fa-user-plus mr-2"></i>Enroll
                                            </a>';
                                    }
                    echo '      </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<div class="col-span-3 text-center py-12">
                        <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-xl text-gray-500">No courses available at the moment.</p>
                      </div>';
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
                    button.classList.remove('border');
                } else {
                    button.classList.remove('pagination-active');
                    button.classList.add('border');
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