
<?php
require_once __DIR__.'/../../controllers/TagController.php';

use App\Controllers\TagController;

$tagController = new TagController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addTag'])) {
    $tagName = $_POST['name_tag'];
    $message = $tagController->addTag($tagName);
}

 $tags = $tagController->getTags();

if (isset($_GET['delete_id'])) {
    $deleteMessage = $tagController->deleteTag($_GET['delete_id']);
    $tags = $tagController->getTags(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateTag'])) {
    $tagName = $_POST['name_tag'];
    $tagId = $_POST['tag_id'];
    $message = $tagController->updateTag($tagId, $tagName);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <title>Tags Dashboard</title>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="flex flex-col w-64 bg-gradient-to-b from-indigo-700 to-indigo-600 text-white shadow-lg">
            <div class="flex items-center justify-center h-16 bg-indigo-800">
                <span class="text-2xl font-bold uppercase">DivoBlog</span>
            </div>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 p-4 space-y-2">
                    <a href="category.php" class="flex items-center p-3 text-gray-100 hover:bg-indigo-500 rounded-md">
                        <i class="fas fa-tag h-6 w-6 mr-2"></i> categories
                    </a>
                    <a href="statistics.php" class="flex items-center p-3 text-gray-100 hover:bg-indigo-500 rounded-md">
                        <i class="fas fa-tachometer-alt h-6 w-6 mr-2"></i> Dashboard
                    </a>
                    <a href="validation.php" class="flex items-center p-3 text-gray-100 hover:bg-indigo-500 rounded-md">
                        <i class="fas fa-newspaper h-6 w-6 mr-2"></i> users
                    </a>
                    <div class="nav-item flex items-center">
                      <i class="fas fa-book-open mr-2"></i>
                      <a href="/App/views/teacher/ManageCourses.php" class="hover:text-blue-200">Courses</a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-white">
            <header class="flex items-center justify-between p-6 bg-white shadow-md">
                <div class="flex items-center">
                    <span class="text-2xl font-bold">Manage Tags</span>
                </div>
            </header>

            <main class="flex-1 p-6 space-y-6">

                <!-- Success or Error message -->
                <?php if (!empty($message)): ?>
                    <div class="bg-green-100 text-green-800 p-4 rounded-md">
                        <?= $message; ?>
                    </div>
                <?php endif; ?>

                <!-- Tag Form -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6 border-t-4 border-indigo-600">
                    <form method="POST" class="space-y-4">
                        <div>
                            <label for="tag_name" class="block text-sm font-medium text-gray-700">Tag Name</label>
                            <input type="text" name="name_tag" id="tag_name" placeholder="Enter tag name"
                                class="mt-2 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <button type="submit" name="addTag"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200">Add Tag</button>
                    </form>
                </div>

                <!-- Tags Table -->
                <div class="bg-white shadow-md rounded-lg p-6 mt-6 overflow-x-auto border-t-4 border-indigo-600">
                    <table class="min-w-full table-auto">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-4 py-2 text-center">Number</th>
                                <th class="px-4 py-2 text-center">Tag Name</th>
                                <th class="px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <?php foreach ($tags as $index => $tag): ?>
                                <tr class="hover:bg-gray-100 transition duration-200 ease-in-out">
                                    <td class="px-4 py-2 text-center"><?= $index + 1; ?></td>
                                    <td class="px-4 py-2 text-center"><?= htmlspecialchars($tag['name']); ?></td>
                                    <td class="px-4 py-2 text-center">
                                        <!-- Edit icon -->
                                        <a href="updateTag.php?id=<?= $tag['id']; ?>" class="cursor-pointer hover:text-blue-500">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Delete icon -->
                                        <a href="tag.php?delete_id=<?= $tag['id']; ?>" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer">
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





