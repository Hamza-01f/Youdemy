<?php

require_once __DIR__ . '/../../Controllers/approveRejectController.php';

use App\Models\approve_reject;

$userHandler = new approve_reject();

$users = $userHandler->fetchUsers();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin - Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }

        .nav-item {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-item:hover {
            transform: translateY(-2px);
        }

        .nav-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #60a5fa;
            transition: width 0.3s ease;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        .action-button {
            transition: all 0.3s ease;
        }

        .action-button:hover {
            transform: scale(1.05);
        }

        .table-row-animate {
            transition: all 0.2s ease;
        }

        .table-row-animate:hover {
            background-color: #f8fafc;
            transform: translateX(5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="gradient-bg text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-3xl"></i>
                <h1 class="text-2xl font-bold">Youdemy Admin</h1>
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
                            <th class="px-6 py-3 text-left text-gray-700">asked At</th>
                            <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($users as $user): ?>
                            <tr class="table-row-animate">
                                <td class="px-6 py-4">
                                    <img src="<?= $user['profile_image'] ?>" class="h-20 w-16 rounded-full border-2 border-blue-200" alt="Profile">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="font-medium"><?= $user['username'] ?></div>
                                            <div class="text-sm text-gray-500"><?= $user['email'] ?></div>
                                        </div>
                                    </div>
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
                    All Users
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
                            <th class="px-6 py-3 text-left text-gray-700">situation</th>
                            <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="table-row-animate">
                            <td class="px-6 py-4">
                                <img src="/api/placeholder/40/40" class="rounded-full border-2 border-blue-200" alt="Profile">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div>
                                        <div class="font-medium">Marie Dubois</div>
                                        <div class="text-sm text-gray-500">marie.dubois@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full flex items-center w-fit">
                                    <i class="far fa-calendar-alt mr-2"></i>12/01/2024
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full flex items-center w-fit">
                                    <i class="fas fa-user-graduate mr-2"></i>Student
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full flex items-center w-fit">
                                    <i class="fas fa-user-graduate mr-2"></i>active
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center action-button">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                    </button>
                                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center action-button">
                                        <i class="fas fa-unlock mr-2"></i>
                                    </button>
                                    <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 flex items-center action-button">
                                        <i class="fas fa-lock mr-2"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>