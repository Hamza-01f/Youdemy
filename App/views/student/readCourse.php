<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Content - Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }
        .content-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 12px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-2">
                    <div class="gradient-bg p-2 rounded-lg">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Youdemy</span>
                </div>

                <div class="flex items-center space-x-6">
                    <button class="relative">
                        <i class="fas fa-bell text-xl text-gray-600"></i>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                    </button>
                    <div class="flex items-center space-x-3">
                        <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-indigo-200">
                        <div class="hidden md:block">
                            <p class="font-medium text-gray-900">John Doe</p>
                            <p class="text-sm text-gray-500">Student</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Course Header -->
    <div class="relative">
        <!-- Course Banner Image -->
        <div class="h-64 md:h-80 w-full overflow-hidden relative">
            <!-- PHP: Replace with actual image URL -->
            <img src="https://www.nullplex.com/uploads/blogs/coverimages/fad4b53c-9630-48ab-bcbf-2a9b3c536119-20240130071903.png" 
                 alt="Course Banner" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        </div>
        
        <!-- Course Info Overlay -->
        <div class="absolute bottom-0 left-0 right-0">
            <div class="max-w-7xl mx-auto px-4 pb-8">
                <div class="text-white">
                    <!-- PHP: Replace with actual course title -->
                    <h1 class="text-4xl font-bold mb-4">UI/UX Design Mastery</h1>
                    <div class="flex flex-wrap items-center gap-6">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-clock"></i>
                            <!-- PHP: Replace with actual duration -->
                            <span>12 hours</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar"></i>
                            <!-- PHP: Replace with actual date -->
                            <span>Created: Jan 15, 2024</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user"></i>
                            <!-- PHP: Replace with actual author -->
                            <span>By Sarah Wilson</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Course Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Video Section -->
                <div class="bg-white rounded-2xl p-6 content-shadow">
                    <h2 class="text-2xl font-bold mb-6">Course Content</h2>
                    <div class="video-container mb-6">
                        <!-- PHP: Replace src with actual video URL from database -->
                        <iframe 
                            src="https://www.youtube.com/watch?v=bEGNvUxYf2o&list=PLr3d3QYzkw2xabQRUpcZ_IBk9W50M9pe-&index=40" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="bg-white rounded-2xl p-6 content-shadow">
                    <h2 class="text-2xl font-bold mb-6">Course Description</h2>
                    <!-- PHP: Replace with actual course description -->
                    <p class="text-gray-600 leading-relaxed">
                        Master modern UI/UX design principles and tools with this comprehensive course. 
                        Learn everything from user research and wireframing to prototyping and design systems. 
                        Perfect for beginners and intermediate designers looking to upgrade their skills.
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 content-shadow sticky top-24">
                    <h3 class="text-xl font-bold mb-6">Course Progress</h3>
                    <div class="space-y-6">
                        <!-- Progress Bar -->
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Overall Progress</span>
                                <span class="font-medium">45%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full">
                                <div class="h-full w-[45%] bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full"></div>
                            </div>
                        </div>

                        <!-- Course Stats -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-gray-500 text-sm mb-1">Time Spent</div>
                                <div class="font-bold">2.5 hrs</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="text-gray-500 text-sm mb-1">Sections</div>
                                <div class="font-bold">4/8</div>
                            </div>
                        </div>

                        <!-- Next Section Button -->
                        <button class="w-full py-3 px-6 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors flex items-center justify-center space-x-2">
                            <span>Next Section</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>