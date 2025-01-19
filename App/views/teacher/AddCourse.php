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
     <link rel="stylesheet" href="/../../../public/style.css">
</head>
<body class="bg-gray-50">
    <!-- Animated Background -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/80 via-indigo-50/80 to-purple-50/80"></div>
        <div class="absolute top-0 left-0 w-1/2 h-1/2 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/4 w-1/2 h-1/2 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Enhanced Navigation -->
    <nav class="glass-nav sticky top-0 z-50 border-b border-gray-200/50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-8">
                <a href="../index.php" class="flex items-center space-x-4 group">
                    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 p-2.5 rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-graduation-cap text-2xl text-white logo-spin"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                        Youdemy
                    </span>
                </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="ManageCourses.php" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-300">
                            <i class="fas fa-tasks mr-2"></i>Manage Courses
                        </a>
                        <a href="Statistics.php" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-300">
                            <i class="fas fa-chart-line mr-2"></i>Analytics
                        </a>
                        <a href="seeCourses.php" class="px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-300">
                            <i class="fas fa-book mr-2"></i>My Courses
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="relative group">
                        <img src="<?php echo $_SESSION['user']['profile_image']?>" alt="Profile" 
                             class="w-12 h-12 rounded-xl border-2 border-indigo-200 group-hover:border-indigo-400 transition-all duration-300 shadow-lg">
                        <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white shadow-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
                        Create New Course
                    </h1>
                    <p class="text-gray-600">Share your knowledge with the world</p>
                </div>
            </div>

            <!-- Form -->
            <form action="/../../../router.php" method="POST" class="space-y-8" id="createCourseForm" onsubmit="return validateForm()">
                <input type="hidden" name="action" value="save_course">
                <input type="hidden" name="author" value="<?php echo $userId ?>">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content Section -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Basic Information Card -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                            <div class="flex items-center space-x-4 mb-8">
                                <div class="p-3 bg-indigo-100 rounded-xl">
                                    <i class="fas fa-info-circle text-indigo-600 text-xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800">Course Information</h2>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2 text-gray-700" for="title">Course Title</label>
                                    <input type="text" id="title" name="title" placeholder="Enter an engaging title for your course" 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 input-focus" >
                                    <span id="titleError" class="text-red-500 text-sm hidden">Title is required</span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-2 text-gray-700" for="description">Course Description</label>
                                    <textarea rows="4" id="description" name="description" placeholder="Describe what students will learn from your course" 
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 input-focus custom-scrollbar" ></textarea>
                                    <span id="descriptionError" class="text-red-500 text-sm hidden">Description is required</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium mb-2 text-gray-700" for="content_type">Content Type</label>
                                        <select name="content_type" id="content_type" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300" >
                                            <option value="document">Document</option>
                                            <option value="video">Video</option>
                                        </select>
                                        <span id="contentTypeError" class="text-red-500 text-sm hidden">Content Type is required</span>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium mb-2 text-gray-700" for="category_id">Category</label>
                                        <select name="category_id" id="category_id" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300">
                                            <option value="">Select category</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="categoryError" class="text-red-500 text-sm hidden">Category is required</span>
                                    </div>
                                </div>

                                <div id="documentContent">
                                    <label class="block text-sm font-medium mb-2 text-gray-700" for="document">Course Content</label>
                                    <textarea rows="6" id="document" name="document" placeholder="Enter your course content here" 
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 input-focus custom-scrollbar"></textarea>
                                </div>

                                <div id="videoContent" style="display: none;">
                                    <label class="block text-sm font-medium mb-2 text-gray-700" for="content">Video URL</label>
                                    <input type="url" id="content" name="content" placeholder="Enter your video URL" 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 input-focus">
                                </div>
                            </div>
                        </div>

                     
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                            <div class="flex items-center space-x-4 mb-8">
                                <div class="p-3 bg-purple-100 rounded-xl">
                                    <i class="fas fa-tags text-purple-600 text-xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800">Course Tags</h2>
                            </div>

                            <select id="tags" name="tags[]" class="w-full" multiple >
                                <?php foreach ($tag as $tagItem): ?>
                                    <option value="<?= $tagItem['id'] ?>"><?= htmlspecialchars($tagItem['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span id="tagsError" class="text-red-500 text-sm hidden">At least one tag is required</span>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-24 card-hover">
                            <div class="flex items-center space-x-4 mb-8">
                                <div class="p-3 bg-blue-100 rounded-xl">
                                    <i class="fas fa-image text-blue-600 text-xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800">Course Image</h2>
                            </div>

                            <div class="space-y-6">
                                <div class="aspect-w-16 aspect-h-9 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 p-8 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4 floating"></i>
                                        <p class="text-gray-500">Upload your course thumbnail</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-2 text-gray-700" for="courseImage">Image URL</label>
                                    <input type="text" id="courseImage" name="courseImage" placeholder="Enter image URL" 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 input-focus" >
                                    <span id="courseImageError" class="text-red-500 text-sm hidden">Image URL is required</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
    <script src="/../../../public/script.js"></script>
</body>
</html>
