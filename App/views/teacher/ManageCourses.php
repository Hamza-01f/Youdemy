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
<body class="bg-gray-50">
    <nav class="bg-indigo-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Youdemy</h1>
            <div class="space-x-4">
                <a href="AddCourse.php" class="text-gray-900 hover:text-blue-600 transition-colors duration-200 font-medium">AddCourse</a>
                <a href="Statistics.php" class="text-gray-900 hover:text-blue-600 transition-colors duration-200 font-medium">Analytics</a>
                <span class="font-medium">Welcom Back Professor: <?php echo $name ?></span>
                <button class="bg-indigo-500 hover:bg-indigo-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                </button>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Cours</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Titre du cours</th>
                            <th class="px-6 py-3 text-left text-gray-700">Catégorie</th>
                            <th class="px-6 py-3 text-left text-gray-700">Statut</th>
                            <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($courses as $course): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4"><?= htmlspecialchars($course['title']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($course['category_name']) ?></td>
                            <td class="px-6 py-4">
                                <div>
                                    <?php if($course['status'] === 'pending' ):  ?>
                                        <a href="?id=<?= $course['id'] ?>&action=pending" class="text-white">
                                            <button class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded-lg shadow-md">PENDING</button>
                                        </a>
                                    <?php else: ?>
                                        <a href="?id=<?= $course['id'] ?>&action=active" class="text-white">
                                            <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg shadow-md">ACTIVE</button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                 
                                    <a href="updateCourse.php?id=<?= $course['id'] ?>" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                               
                                    <a href="?id=<?= $course['id'] ?>&action=delete" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this course?');">
                                        <i class="fas fa-trash"></i>
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
</body>
</html>
