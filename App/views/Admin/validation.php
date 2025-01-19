<?php

require_once __DIR__ . '/../../Controllers/approveRejectController.php';
require_once __DIR__ . '/../../Models/User.php';

use App\Models\User;



$requestedUsers = User::fetchRequestedUsers();

$allUsers = User::fetchUsers();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin - Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/../../../public/style.css">
</head>
<body class="bg-gray-50">
    <nav class="gradient-bg text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
               <a href="../index.php" class="flex items-center space-x-4 group">
                    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 p-2.5 rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-graduation-cap text-2xl text-white logo-spin"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                        Youdemy
                    </span>
                </a>
            </div>
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
                <div class="nav-item flex items-center">
                    <i class="fas fa-book-open mr-2"></i>
                    <a href="/App/views/teacher/ManageCourses.php" class="hover:text-blue-200">Courses</a>
                </div>
                <div class="flex items-center space-x-4 ml-6 border-l pl-6">
                    <a href="../LogOut.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg flex items-center action-button">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6 space-y-6">
        
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-user-check mr-3 text-blue-600"></i>
                    Teachers Account Validation
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Photo</th>
                            <th class="px-6 py-3 text-left text-gray-700">User</th>
                            <th class="px-6 py-3 text-left text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-gray-700">Asked At</th>
                            <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($requestedUsers as $user): ?>
                            <tr class="table-row-animate">
                                <td class="px-6 py-4">
                                    <img src="<?= $user['profile_image'] ?>" class="h-20 w-16 rounded-full border-2 border-blue-200" alt="Profile">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium"><?= $user['username'] ?></div>
                                    <div class="text-sm text-gray-500"><?= $user['email'] ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full flex items-center w-fit">
                                        <i class="fas fa-clock mr-2"></i>Waiting
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full flex items-center w-fit">
                                        <i class="far fa-calendar-alt mr-2"></i><?= $user['created_at'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <form method="POST" action="/App/Controllers/approveRejectController.php">
                                            <input type="hidden" name="id" value="<?= $user['user_id'] ?>" />
                                            <button name="approve" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center action-button">
                                                <i class="fas fa-check mr-2"></i>Approve
                                            </button>
                                            <button name="reject" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center action-button">
                                                <i class="fas fa-times mr-2"></i>Reject
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-users mr-3 text-blue-600"></i>
                    All Users Management
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Photo</th>
                            <th class="px-6 py-3 text-left text-gray-700">Personal Info</th>
                            <th class="px-6 py-3 text-left text-gray-700">Joined At</th>
                            <th class="px-6 py-3 text-left text-gray-700">Role</th>
                            <th class="px-6 py-3 text-left text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($allUsers as $user): ?>
                            <tr class="table-row-animate">
                                <td class="px-6 py-4">
                                    <img src="<?= $user['profile_image'] ?>" class="h-18 w-16 rounded-full border-2 border-blue-200" alt="Profile">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium"><?= $user['username'] ?></div>
                                    <div class="text-sm text-gray-500"><?= $user['email'] ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full flex items-center w-fit">
                                        <i class="far fa-calendar-alt mr-2"></i><?= $user['created_at'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full flex items-center w-fit">
                                        <i ></i><?= $user['role'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 <?= $user['status'] == 'suspended' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?> rounded-full flex items-center w-fit">
                                        <i ></i><?= ucfirst($user['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <form method="POST" action="">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                                            
                                            <?php if ($user['status'] != 'suspended'): ?>
                                                <button name="block" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 flex items-center action-button">
                                                    <i class="fas fa-ban mr-2"></i>Block
                                                </button>
                                            <?php else: ?>
                                                <button name="unblock" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center action-button">
                                                    <i class="fas fa-unlock-alt mr-2"></i>Unblock
                                                </button>
                                            <?php endif; ?>

                                            <button name="delete" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center action-button">
                                                <i class="fas fa-trash-alt mr-2"></i>Delete
                                            </button>
                                        </form>
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
