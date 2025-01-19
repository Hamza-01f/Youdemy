<?php
require_once __DIR__.'/../../controllers/TagController.php';

use App\Controllers\TagController;

$tagController = new TagController();
$tagToUpdate = null;
$message = '';

if (isset($_GET['id'])) {
    $tagId = $_GET['id'];
    $tags = $tagController->getTags();

    foreach ($tags as $tag) {
        if ($tag['id'] == $tagId) {
            $tagToUpdate = $tag;
            break;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateTag'])) {
        $tagName = $_POST['name_tag'];
        $tagController->updateTag($tagId, $tagName);

        header('Location:tag.php');
        exit; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Update Tag</title>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white flex-none">
            <nav class="flex-1 p-4 space-y-2">
                <a href="../index.php" class="flex items-center space-x-4 group">
                    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 p-2.5 rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-graduation-cap text-2xl text-white logo-spin"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                        Youdemy
                    </span>
                </a>
                <a href="/App/views/Admin/statistics.php" class="flex items-center p-3 text-gray-200 hover:bg-gray-700 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Dashboard
                </a>
                <a href="/App/views/Admin/validation.php" class="flex items-center p-3 text-gray-200 hover:bg-gray-700 rounded-md">
                    <i class="fas fa-users h-6 w-6 mr-2"></i> Users
                </a>
                <a href="/App/views/Admin/category.php" class="flex items-center p-3 text-gray-200 hover:bg-gray-700 rounded-md">
                    <i class="fas fa-th h-6 w-6 mr-2"></i> Categories
                </a>
                <a href="/App/views/Admin/tag.php" class="flex items-center p-3 text-gray-200 hover:bg-gray-700 rounded-md">
                    <i class="fas fa-tag h-6 w-6 mr-2"></i> Tags
                </a>
                <div class="nav-item flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    <a href="/App/views/Admin/seecourses.php" class="hover:text-blue-200">Courses</a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-white">
            <header class="flex items-center justify-between p-6 bg-white shadow-md">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-gray-800">Update Tag</span>
                </div>
            </header>

            <main class="flex-1 p-6 space-y-6">
                <div class="text-3xl font-bold text-gray-900">Update Tag Information</div>

                <!-- Update Form -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="tag_name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                            <input type="text" name="name_tag" id="tag_name" value="<?= htmlspecialchars($tagToUpdate['name']); ?>"
                                class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            <input type="hidden" name="tag_id" value="<?= $tagId; ?>" />
                        </div>
                        <button type="submit" name="updateTag"
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-200">Update Tag</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
</body>
</html>
