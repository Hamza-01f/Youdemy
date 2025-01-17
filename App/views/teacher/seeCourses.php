<?php
session_start();

require_once __DIR__.'/../../../vendor/autoload.php';

$id = $_SESSION['user']['id'];
$courseController = new \App\Controllers\CourseController();

$courses = $courseController->getRelatedCourses($id);
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
    <title>Youdemy - Student Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }
        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.1);
        }
        .nav-button {
            @apply px-6 py-2.5 rounded-full transition-all duration-300 font-medium text-sm;
        }
        .nav-button.primary {
            @apply bg-indigo-600 text-white hover:bg-indigo-700 hover:shadow-lg;
        }
        .nav-button.secondary {
            @apply bg-white text-indigo-600 hover:bg-indigo-50 border-2 border-indigo-600;
        }
        .pagination-active {
            @apply bg-indigo-600 text-white;
        }
        .search-input {
            @apply w-full pl-10 pr-4 py-3 rounded-full border-2 border-gray-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all duration-300;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <div class="gradient-bg p-2.5 rounded-xl">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Youdemy</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <div class="relative w-72">
                        <input type="text" 
                               placeholder="Search courses..." 
                               class="search-input">
                        <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/../LogOut.php" class="nav-button secondary">
                        Log Out
                    </a>
                    <a href="Statistics.php" class="nav-button primary">
                        statistics
                    </a>
                    <a href="AddCourse.php" class="nav-button primary">
                        add course
                    </a>
                    <a href="ManageCourses.php" class="nav-button primary">
                        Manage Courses
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <div class="max-w-7xl mx-auto px-4 py-16" id="courses">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
               Your Available Courses
            </h2>
            <div class="flex space-x-2">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<span onclick="showPage(' . $i . ')" class="w-10 h-10 flex items-center justify-center rounded-full ' . ($i === $page ? 'pagination-active' : 'border-2 border-indigo-600 text-indigo-600') . ' cursor-pointer transition-colors hover:bg-indigo-50">' . $i . '</span>';
                }
                ?>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if (count($currentPageCourses) > 0) {
                foreach ($currentPageCourses as $course) {
                    echo '
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover border border-gray-100">
                            <div class="relative">
                                <img src="'.$course['image_url'].'" alt="'.$course['title'].'" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-4 py-1.5 bg-white/90 backdrop-blur-sm text-indigo-600 rounded-full text-sm font-medium shadow-md">
                                        '.$course['category_name'].' 
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">'.$course['title'].'</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">'.$course['description'].'</p>
                                <div class="flex items-center mb-6">
                                    <img src="'.$course['profile_image'].'" alt="Instructor" class="w-12 h-12 rounded-full border-2 border-indigo-100">
                                    <div class="ml-3">
                                        <p class="font-medium">'.$course['username'].'</p>
                                        <p class="text-sm text-gray-500">Instructor</p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        '.date('M d, Y', strtotime($course['created_at'])).'
                                    </span>
                                    <a href="/App/views/student/readCourse.php?readid='.$course['id'].'&action=read" class="px-6 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors shadow-md hover:shadow-lg">
                                         <i class="fas fa-book-reader mr-2"></i>Review
                                    </a>
                                </div>
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
    </div>
    <?php include __DIR__.'/../../..//public/footer.php' ?>
    <script>
        function showPage(page) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            window.location.href = url;
        }
    </script>
</body>
</html>
