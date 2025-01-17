<?php
session_start();
require_once __DIR__ . '/../../Models/Enrollment.php'; 

use App\Models\Enrollment;

$studentId = $_SESSION['user']['id']; 
$enrollment = new Enrollment();

$enrolledCoursesPerPage = 3;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startLimit = ($currentPage - 1) * $enrolledCoursesPerPage;

$totalEnrolledCourses = $enrollment->getEnrolledCoursesCount($studentId);
$enrolledCourses = $enrollment->getEnrolledCourses($studentId, $enrolledCoursesPerPage, $startLimit);
$nonEnrolledCourses = $enrollment->getNonEnrolledCourses($studentId);
$enrolledPages = ceil($totalEnrolledCourses / $enrolledCoursesPerPage);
?>

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
        .gradient-bg-2 {
            background: linear-gradient(135deg, #10B981 0%, #3B82F6 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
        }
        .enrolled-section {
            background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        }
        .non-enrolled-section {
            background: linear-gradient(135deg, #F0FDF4 0%, #ECFDF5 100%);
        }
        .nav-button {
            transition: all 0.3s ease;
        }
        .nav-button:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50">
  
    <nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="gradient-bg p-3 rounded-xl shadow-lg">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold gradient-text">Youdemy</span>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="Browse.php" class="nav-button px-6 py-2.5 text-gray-700 hover:text-blue-600 font-medium rounded-xl hover:bg-blue-50 transition-all flex items-center space-x-2">
                        <i class="fas fa-compass"></i>
                        <span>Browse Courses</span>
                    </a>
                    <a href="../LogOut.php" class="nav-button px-6 py-2.5 gradient-bg text-white font-medium rounded-xl shadow-md hover:shadow-xl transition-all flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Log out</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="gradient-bg text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-6">My Learning Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-8 card-hover">
                    <h3 class="text-xl mb-3">Enrolled Courses</h3>
                    <div class="text-4xl font-bold"><?php echo count($enrolledCourses); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="enrolled-section rounded-3xl p-8 mt-8 mb-12">
            <h2 class="text-2xl font-bold mb-8 flex items-center">
                <i class="fas fa-book-reader text-blue-600 mr-3"></i>
                My Active Courses
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($enrolledCourses)): ?>
                    <?php foreach ($enrolledCourses as $course): ?>
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                            <div class="relative">
                                <img src="<?php echo $course['image_url']; ?>" alt="Course" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-4 py-1 bg-blue-600 text-white rounded-full text-sm">
                                        Active
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-3"><?php echo $course['title']; ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo $course['description']; ?></p>
                                <a href="readCourse.php?readid=<?php echo $course['id']; ?>" class="inline-block w-full px-6 py-3 text-center gradient-bg text-white rounded-xl hover:opacity-90 transition-opacity">
                                    Continue Learning
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-3 text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No enrolled courses yet</h3>
                        <p class="text-gray-500 mb-6">Start your learning journey by exploring our courses!</p>
                        <a href="Browse.php" class="inline-block px-8 py-3 gradient-bg text-white rounded-xl hover:opacity-90 transition-opacity">
                            Explore Courses
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($enrolledPages > 1): ?>
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-xl bg-white shadow-md p-2">
                        <?php for ($i = 1; $i <= $enrolledPages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" 
                               class="px-4 py-2 rounded-lg <?php echo $currentPage === $i ? 'gradient-bg text-white' : 'text-gray-700 hover:bg-gray-100'; ?> transition-colors">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Non-Enrolled Courses Section -->
        <div class="non-enrolled-section rounded-3xl p-8 mb-12">
            <h2 class="text-2xl font-bold mb-8 flex items-center">
                <i class="fas fa-compass text-green-600 mr-3"></i>
                Recommended Courses
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($nonEnrolledCourses)): ?>
                    <?php foreach ($nonEnrolledCourses as $course): ?>
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                            <div class="relative">
                                <img src="<?php echo $course['image_url']; ?>" alt="Course" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-4 py-1 bg-green-500 text-white rounded-full text-sm">
                                        Available
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-3"><?php echo $course['title']; ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo $course['description']; ?></p>
                                <a href="enroll.php?id=<?php echo $course['id']; ?>" class="inline-block w-full px-6 py-3 text-center gradient-bg-2 text-white rounded-xl hover:opacity-90 transition-opacity">
                                    Enroll Now
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-3 text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">You're All Set!</h3>
                        <p class="text-gray-500">You've enrolled in all available courses. Check back later for new content!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
</body>
</html>
