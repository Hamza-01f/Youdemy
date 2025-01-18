<?php
require_once '../../../vendor/autoload.php';
session_start();

$Studentid = $_SESSION['user']['id'];
$role = $_SESSION['user']['role'];

$courseController = new \App\Controllers\CourseController();
$enrolling = new App\Controllers\EnrollmentController();
$search = new \App\Controllers\CourseController();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if(!empty($searchTerm)){
    $searching = $search->search($Studentid,$role,$searchTerm);
}else{
    $searching = [];
}

$courses = $courseController->getAllowedCourses();

$coursesPerPage = 3;
$totalCourses = count($courses);
$totalPages = ceil($totalCourses / $coursesPerPage);



$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($page - 1) * $coursesPerPage;
$currentPageCourses = array_slice($courses, $startIndex, $coursesPerPage);

if (isset($_GET['enrollid']) && $_GET['action'] === 'enroll') {
    $enrollId = $_GET['enrollid'];
    $enrolling->enrollStudent($Studentid, $enrollId);
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

        .searchingResults {
         margin-top: 80px; 
        }

    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white/80 backdrop-blur-md w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-2">
                    <div class="gradient-bg p-2 rounded-lg">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Youdemy</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <div class="relative w-80">
                       <form id="searchForm" action="" method="get" class="relative w-80">
                            <input type="text" name="search" placeholder="Search for courses" 
                                class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 bg-white/80">
                            <button type="submit" class="absolute left-4 top-4 text-indigo-500">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
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
                        <a href="MesCours.php" class="px-4 py-2 bg-green-400 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-book-open mr-2"></i>my courses
                        </a>
                        <a href="../LogOut.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="searchingResults px-6 max-w-7xl mx-auto mt-24 mb-8 hidden">
          <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const searchResults = document.getElementsByClassName('searchingResults')[0];

                    if (searchResults.querySelector('.course-card')) {
                        searchResults.classList.remove('hidden'); 
                    }
                });
         </script>
        <?php if (!empty($searching)): ?>
            <div class="bg-green-200  backdrop-blur-sm p-8 rounded-2xl border border-gray-200 shadow-lg">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Search Results</h2>
                    <p class="text-gray-600">Found <?php echo count($searching); ?> courses matching your search</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($searching as $course): ?>
                        <div class="bg-white/80 card-gradient rounded-2xl custom-shadow overflow-hidden transform hover:-translate-y-2 transition-all duration-300 course-card">
                            <div class="relative">
                                <img src="<?php echo $course['image_url'] ?>" alt="<?php echo $course['title'] ?>" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 text-gray-800"><?php echo $course['title'] ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo $course['description'] ?></p>
                                <div class="flex items-center mb-6">
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <?php echo date('M d, Y', strtotime($course['created_at'])) ?>
                                    </span>
                                    <?php $isEnrolled = $enrolling->checkEnrollment($Studentid, $course['id']); ?>
                                    <?php if($isEnrolled): ?>
                                        <a href="readCourse.php?readid='.$course['id'].'&action=read" 
                                        class="px-6 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors shadow-md hover:shadow-lg">
                                            <i class="fas fa-book-reader mr-2"></i>Read
                                        </a>
                                    <?php else: ?>
                                        <a href="?enrollid='.$course['id'].'&action=enroll" 
                                        class="px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors shadow-md hover:shadow-lg">
                                            <i class="fas fa-user-plus mr-2"></i>Enroll
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <?php if (!empty($searchTerm)): ?>
                <div class="text-center py-20 bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200 shadow-lg course-card">
                    <i class="fas fa-book-open text-6xl text-gray-300 mb-4 animate-float"></i>
                    <p class="text-2xl text-gray-500">No results found for "<?php echo htmlspecialchars($searchTerm); ?>".</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

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

    <div class="max-w-7xl mx-auto px-4 py-16" id="courses">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Available Courses
            </h2>
            <div class="flex space-x-2">
                <?php
               
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<span onclick="showPage(' . $i . ')" class="w-10 h-10 flex items-center justify-center rounded-full ' . ($i === $page ? 'pagination-active' : 'border') . ' cursor-pointer transition-colors">' . $i . '</span>';
                }
                ?>
            </div>
        </div>

        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="page-1">
            <?php
            if (count($currentPageCourses) > 0) {
                foreach ($currentPageCourses as $course) {
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

        <div class="mt-6 text-center">
            <?php if ($totalPages > 1): ?>
                <div class="flex justify-center space-x-4">
                    <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<a href="?page=' . $i . '" class="px-4 py-2 text-sm bg-gray-200 rounded-full hover:bg-indigo-500 hover:text-white transition-colors ' . ($i === $page ? 'pagination-active' : '') . '">' . $i . '</a>';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
    <script>

    </script>
</body>
</html>
