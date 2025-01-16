<?php

session_start();

$userId = $_SESSION['user']['id'];

require_once __DIR__.'/../../controllers/CategoryController.php';

require_once __DIR__.'/../../controllers/TagController.php';

use  App\Controllers\CategoryController;
use  App\Controllers\TagController;

$categoryController = new CategoryController();
$categories = $categoryController->getCategories();

$categoryTags = new TagController();
$tag = $categoryTags->getTags();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Course - Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/css/tom-select.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/js/tom-select.complete.min.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
        }
        .upload-area {
            background: url("data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' stroke='%23CBD5E1' stroke-width='3' stroke-dasharray='6%2c 14' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e");
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .hover-scale {
            transition: transform 0.2s;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .custom-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <nav class="glass-effect shadow-lg border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-2 hover-scale">
                        <i class="fas fa-graduation-cap text-2xl text-blue-600"></i>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 text-transparent bg-clip-text">Youdemy</span>
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="ManageCourses.php" class="text-gray-900 hover:text-blue-600 transition-colors duration-200 font-medium">Manage Courses</a>
                        <a href="Statistics.php" class="text-gray-900 hover:text-blue-600 transition-colors duration-200 font-medium">Analytics</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-colors duration-200">
                        <i class="fas fa-bell text-xl"></i>
                    </button>
                    <div class="relative">
                        <img src="/api/placeholder/32/32" alt="Profile" class="w-10 h-10 rounded-full border-2 border-blue-200 hover:border-blue-400 transition-colors duration-200">
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    
    <div class="flex justify-center items-center min-h-screen py-12 relative z-10">
        <div class="max-w-7xl w-full px-4">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 text-transparent bg-clip-text">Create New Course</h1>
            </div>

            <form action="/../../../router.php" method="POST">
    <input type="hidden" name="action" value="save_course">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="col-span-1 md:col-span-2 space-y-6">
            <div class="bg-white rounded-xl custom-shadow p-8 hover-scale transition-all duration-300">
                <div class="flex items-center space-x-3 mb-6">
                    <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                    <h2 class="text-xl font-bold">Basic Information</h2>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700">Course Title</label>
                        <input type="text" name="title" placeholder="Enter course title" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700">Course Description</label>
                        <textarea rows="4" name="description" placeholder="Enter course description" 
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700">Content Type</label>
                        <select name="content_type" id="content_type" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option value="document">Document</option>
                            <option value="video">Video</option>
                        </select>
                    </div>

                    <div id="documentContent" >
                        <label class="block text-sm font-medium mb-2 text-gray-700">Course Content</label>
                        <textarea rows="4" name="document" placeholder="Enter course content" 
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"></textarea>
                    </div>

                    <div id="videoContent" style="display: none;">
                        <label class="block text-sm font-medium mb-2 text-gray-700">Video URL</label>
                        <input type="url" name="content" placeholder="Enter video URL" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700">Category</label>
                        <select name="category_id" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <option>Select category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl custom-shadow p-8 hover-scale transition-all duration-300">
                <div class="flex items-center space-x-3 mb-6">
                    <i class="fas fa-tags text-blue-600 text-xl"></i>
                    <h2 class="text-xl font-bold">Tags</h2>
                </div>
                <div class="space-y-4">
                    <select id="tags" name="tags[]" class="w-full" multiple>
                        <?php foreach ($tag as $tagItem): ?>
                            <option value="<?= $tagItem['id'] ?>"><?= htmlspecialchars($tagItem['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <input type="hidden" name="author" value="<?php echo $userId ?>">

        <div class="col-span-1">
            <div class="bg-white rounded-xl custom-shadow p-8 sticky top-24 hover-scale transition-all duration-300">
                <div class="flex items-center space-x-3 mb-6">
                    <i class="fas fa-link text-blue-600 text-xl"></i>
                    <h2 class="text-xl font-bold">Course URL</h2>
                </div>
                <div class="space-y-6">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-50 rounded-lg mb-4 border-2 border-dashed border-gray-200 flex items-center justify-center">
                        <i class="fas fa-image text-4xl text-gray-300"></i>
                    </div>   
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-700">Course Image URL</label>
                        <div class="flex items-center space-x-2">
                            <input type="url" name="courseImage" placeholder="course Image" 
                                   class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 text-right">
        <button type="submit" 
                class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transform hover:-translate-y-1 transition-all duration-200 font-medium shadow-lg hover:shadow-xl">
            <i class="fas fa-plus-circle mr-2"></i>
            Create Course
        </button>
    </div>
</form>
        </div>
    </div>

    <script>
       
        new TomSelect("#tags", {
            create: false,
            maxItems: 5,
            placeholder: "Select tags...",
            persist: false,
        });

        document.getElementById('content_type').addEventListener('change', function() {
        if (this.value === 'video') {
            document.getElementById('documentContent').style.display = 'none';
            document.getElementById('videoContent').style.display = 'block';
        } else {
            document.getElementById('documentContent').style.display = 'block';
            document.getElementById('videoContent').style.display = 'none';
        }
        });
    </script>
</body>
</html>
