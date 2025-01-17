<?php
session_start();

$name = $_SESSION['user']['username'];

require_once __DIR__.'/../../controllers/CourseController.php';
require_once __DIR__.'/../../controllers/CategoryController.php';
require_once __DIR__.'/../../controllers/TagController.php';

use  App\Controllers\CategoryController;
use  App\Controllers\TagController;
use  App\Controllers\CourseController;

$courseController = new CourseController();
$courses = $courseController->getCourses();


if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $deletecourse = new CourseController();
    $deletecourse->deleteCourse($id);
}

if (isset($_GET['action']) && $_GET['action'] === 'active' && isset($_GET['id'])) {
    $id = $_GET['id'];
    CourseController::active($id); 
}

if (isset($_GET['action']) && $_GET['action'] === 'pending' && isset($_GET['id'])) {
    $id = $_GET['id'];
    CourseController::pending($id); 
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Gestion des Cours</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
   
    <nav class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h1 class="text-3xl font-bold">Youdemy</h1>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <?php if($_SESSION['user']['role'] == 'admin'): ?>
                        <div class="flex items-center space-x-6">
                        <div class="nav-item flex items-center">
                            <i class="fas fa-tags mr-2"></i>
                            <a href="/App/views/Admin/tag.php" class="hover:text-blue-200">Tags</a>
                        </div>
                        <div class="nav-item flex items-center">
                            <i class="fas fa-th-large mr-2"></i>
                            <a href="/App/views/Admin/category.php" class="hover:text-blue-200">Categories</a>
                        </div>
                        <div class="nav-item flex items-center">
                            <i class="fas fa-chart-bar mr-2"></i>
                            <a href="/App/views/Admin/statistics.php" class="hover:text-blue-200">Statistics</a>
                        </div>
                        <div class="nav-item flex items-center">
                            <i class="fas fa-search mr-2"></i>
                            <a href="/App/views/Admin/seecourses.php" class="hover:text-blue-200">Browse</a>
                        </div>
                        <div class="flex items-center space-x-4 ml-6 border-l pl-6">
                            <a href="/App/views/logOut.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg flex items-center action-button">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="AddCourse.php" class="px-4 py-2 rounded-full bg-white text-indigo-700 hover:bg-indigo-100 transition-colors duration-200 font-medium flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i>Add Course
                        </a>
                        <a href="Statistics.php" class="px-4 py-2 rounded-full bg-white text-indigo-700 hover:bg-indigo-100 transition-colors duration-200 font-medium flex items-center">
                            <i class="fas fa-chart-line mr-2"></i>Analytics
                        </a>
                        <a href="seeCourses.php" class="px-4 py-2 rounded-full bg-white text-indigo-700 hover:bg-indigo-100 transition-colors duration-200 font-medium flex items-center">
                            <i class="fas fa-book mr-2"></i>My Courses
                        </a>
                        <div class="flex items-center space-x-4">
                            <span class="font-medium">Welcome Back Professor: <?php echo $name ?></span>
                            <a href="/App/views/logOut.php" class="px-4 py-2 rounded-full bg-red-500 hover:bg-red-600 text-white transition-colors duration-200 flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-b from-indigo-800 to-indigo-900 text-white py-16">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://i.pinimg.com/736x/eb/36/5d/eb365db8255ddf92d5e2d46fa06cc246.jpg" alt="Education Background" class="w-full h-full object-cover opacity-10"/>
        </div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold mb-4">Course Management Dashboard</h1>
                <p class="text-xl text-indigo-200">Efficiently manage Educational content and track course performance all in one place.</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto p-6 flex-grow">
        <div class="bg-white rounded-xl shadow-xl p-8 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Course Management</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider rounded-tl-lg">Course Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Category</th>
                            <?php if($_SESSION['user']['role'] == 'admin'): ?>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <?php endif; ?>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider rounded-tr-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($courses as $course): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 mr-4">
                                        <img class="h-10 w-10 rounded-full" src="<?= htmlspecialchars($course['image_url']) ?>" alt="Course thumbnail"/>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($course['title']) ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    <?= htmlspecialchars($course['category_name']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($_SESSION['user']['role'] == 'admin'): ?>
                                    <?php if($course['status'] === 'pending' ):  ?>
                                        <a href="?id=<?= $course['id'] ?>&action=pending" class="inline-flex">
                                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-lg bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-2"></i>PENDING
                                            </span>
                                        </a>
                                    <?php else: ?>
                                        <a href="?id=<?= $course['id'] ?>&action=active" class="inline-flex">
                                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-lg bg-green-100 text-green-800">
                                                <i class="fas fa-check mr-2"></i>ACTIVE
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-4">
                                    <a href="updateCourse.php?id=<?= $course['id'] ?>" class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <a href="?id=<?= $course['id'] ?>&action=delete" class="text-red-600 hover:text-red-900 transition-colors duration-200" 
                                       onclick="return confirm('Are you sure you want to delete this course?');">
                                        <i class="fas fa-trash text-lg"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include __DIR__.'/../../../public/footer.php' ?>
</body>
</html>
