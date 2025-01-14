<!--p 

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /app/view/AdmineDashboard/users/logIn.php');
    exit();
}

 require_once __DIR__ . '/../../../controllers/CategoriesController.php';

use App\Controllers\CategoriesController;
use App\Models\ModelCategories;

$categories = CategoriesController::show();
// $totalTags = TagsController::totalTags();
// TagsController::create();

if (isset($_POST['addCategory']) && isset($_POST['categorie_name']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $value = $_POST['categorie_name'];
    $result = CategoriesController::create($value);
}


// // Check if the delete action is triggered
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    CategoriesController::delete($id); 
}
?-->

<?php
require_once __DIR__.'/../controllers/CategoryController.php';

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
</head>

<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <div class="flex flex-col w-64 bg-gray-800 text-white shadow-lg">
            <div class="flex items-center justify-center h-16 bg-gray-900">
                <span class="text-2xl font-bold uppercase">DivoBlog</span>
            </div>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 p-4 space-y-2">
                    <a href="/app/view/AdmineDashboard/AdmineDashboard.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="/app/view/AdmineDashboard/articles/ManageArticles.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-newspaper h-6 w-6 mr-2"></i> Articles
                    </a>
                    <a href="/app/view/AdmineDashboard/Tags/tag.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-tag h-6 w-6 mr-2"></i> Tags
                    </a>
                    <a href="category.php" class="flex items-center p-3 text-gray-100 hover:bg-gray-700 rounded-md">
                        <i class="fas fa-th h-6 w-6 mr-2"></i> Categories
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-white">
            <header class="flex items-center justify-between p-6 bg-white shadow-md">
                <div class="flex items-center">
                    <span class="text-2xl font-bold">Manage Categories</span>
                </div>
            </header>

            <main class="flex-1 p-6 space-y-6">
                <!-- Success or Error message -->
                <?php if (!empty($message)): ?>
                    <div class="bg-green-100 text-green-800 p-4 rounded-md">
                        <?= $message; ?>
                    </div>
                <?php endif; ?>

                <!-- Add Category Form -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6 border-t-4 border-indigo-600">
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="categorie_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="categorie_name" id="categorie_name" placeholder="Enter category name"
                                class="mt-2 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <button type="submit" name="addCategory"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">Add Category</button>
                    </form>
                </div>

                <!-- Categories Table -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6 overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-2 text-center">Number</th>
                                <th class="px-4 py-2 text-center">Category Name</th>
                                <th class="px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <?php foreach ($categories as $index => $category): ?>
                                <tr class="hover:bg-gray-100 transition duration-200 ease-in-out">
                                    <td class="px-4 py-2 text-center"><?= $index + 1; ?></td>
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($category['name']); ?></td>
                                    <td class="px-4 py-2 text-center">
                                        <!-- Edit icon -->
                                        <a href="updateCategory.php?id=<?= $category['id']; ?>" class="cursor-pointer hover:text-blue-500">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Delete icon -->
                                        <a href="category.php?delete_id=<?= $category['id']; ?>" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

</body>

</html>


