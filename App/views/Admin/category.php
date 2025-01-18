<?php
require_once __DIR__.'/../../controllers/CategoryController.php';

use App\Controllers\CategoryController;

$categoryController = new CategoryController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCategory'])) {
    $categoryName = $_POST['categorie_name'];
    $message = $categoryController->addCategory($categoryName);
}

$categories = $categoryController->getCategories();

if (isset($_GET['delete_id'])) {
    $deleteMessage = $categoryController->deleteCategory($_GET['delete_id']);
    $categories = $categoryController->getCategories();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Categories Dashboard</title>
    <link rel="stylesheet" href="/../../../public/style.css">
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Enhanced Sidebar -->
        <div class="flex flex-col w-64 bg-gradient-to-b from-indigo-900 to-indigo-700 text-white shadow-xl">
            <div class="flex items-center justify-center h-20 bg-indigo-800">
                <i class="fas fa-graduation-cap text-3xl mr-2 text-indigo-300"></i>
                <span class="text-2xl font-bold">Youdemy</span>
            </div>
            
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 p-6 space-y-4">
                    <a href="statistics.php" class="nav-item flex items-center p-4 text-gray-100 hover:bg-indigo-800 rounded-xl transition-all duration-300">
                        <i class="fas fa-chart-line mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="seecourses.php" class="nav-item flex items-center p-4 text-gray-100 hover:bg-indigo-800 rounded-xl transition-all duration-300">
                        <i class="fas fa-newspaper mr-3"></i>
                        <span>Courses</span>
                    </a>
                    <a href="tag.php" class="nav-item flex items-center p-4 text-gray-100 hover:bg-indigo-800 rounded-xl transition-all duration-300">
                        <i class="fas fa-tags mr-3"></i>
                        <span>Tags</span>
                    </a>
                    <a href="validation.php" class="nav-item flex items-center p-4 text-gray-100 hover:bg-indigo-800 rounded-xl transition-all duration-300">
                        <i class="fas fa-users mr-3"></i>
                        <span>Users</span>
                    </a>
                    <a href="/App/views/teacher/ManageCourses.php" class="nav-item flex items-center p-4 text-gray-100 hover:bg-indigo-800 rounded-xl transition-all duration-300">
                        <i class="fas fa-book-open mr-3"></i>
                        <span>Manage Courses</span>
                    </a>
                </nav>
            </div>
        </div>


        <div class="flex-1 flex flex-col bg-gray-50">
         
            <header class="bg-white shadow-md px-8 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Category Management</h1>
                </div>
            </header>

            <main class="flex-1 p-8 overflow-y-auto">
          
                <?php if (!empty($message)): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md animate-fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?= $message; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Enhanced Add Category Form -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8 card-hover border border-gray-100">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800">Add New Category</h2>
                    <form method="POST" class="space-y-4">
                        <div class="flex flex-col space-y-2">
                            <label for="categorie_name" class="text-sm font-medium text-gray-700">Category Name</label>
                            <div class="relative">
                                <input type="text" 
                                    name="categorie_name" 
                                    id="categorie_name" 
                                    placeholder="Enter category name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                                    required>
                                <i class="fas fa-folder absolute right-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <button type="submit" 
                            name="addCategory"
                            class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 text-white py-3 rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition duration-300 flex items-center justify-center">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Add Category
                        </button>
                    </form>
                </div>

                <!-- Enhanced Categories Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800">Categories List</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">#</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Category Name</th>
                                    <th class="px-6 py-4 text-right text-sm font-medium text-gray-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($categories as $index => $category): ?>
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $index + 1; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <?= htmlspecialchars($category['name']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="updateCategory.php?id=<?= $category['id']; ?>" 
                                           class="text-indigo-600 hover:text-indigo-900 mr-4 transition duration-150">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="category.php?delete_id=<?= $category['id']; ?>" 
                                           class="text-red-600 hover:text-red-900 transition duration-150">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php'; ?>
</body>
</html>