<?php

require_once __DIR__.'/vendor/autoload.php';


$id = null;
$role = 'visitor';


$courseController = new \App\Controllers\CourseController();
$search = new \App\Controllers\CourseController();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if(!empty($searchTerm)){
    $searching = $search->search($id,$role,$searchTerm);
}

$courses = $courseController->getAllowedCourses();

$coursesPerPage = 3;
$totalCourses = count($courses);
$totalPages = ceil($totalCourses / $coursesPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($page - 1) * $coursesPerPage;
$currentPageCourses = array_slice($courses, $startIndex, $coursesPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Transform Your Future</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body class="bg-gray-50">
    <nav class="navbar-blur  w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
          
                <a href="../index.php" class="flex items-center space-x-4 group">
                    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 p-2.5 rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-graduation-cap text-2xl text-white logo-spin"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                        Youdemy
                    </span>
                </a>
                
               
                <div class="hidden md:flex items-center space-x-8">
                    <div class="hidden md:flex items-center space-x-8">
                        <div class="relative w-80">
                        <form id="searchForm" action="" method="get" class="relative w-80">
                                <input type="text" name="search" placeholder="Search for courses" 
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 bg-white/80">
                                <button type="submit" class="absolute left-4 top-4 text-indigo-500">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/App/views/logIn.php" 
                       class="px-6 py-2 text-indigo-600 hover:text-indigo-700 font-medium transition-colors">
                        Sign In
                    </a>
                    <a href="/App/views/Register.php" 
                       class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="searchingResults px-6 max-w-7xl mx-auto mt-24 mb-8 hidden"> 
        <?php if (!empty($searching)): ?>
        
            <div class="bg-green-200 backdrop-blur-sm p-8 rounded-2xl border border-gray-200 shadow-lg">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Search Results</h2>
                    <p class="text-gray-600">Found <?php echo count($searching); ?> courses matching your search</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($searching as $course): ?>
                        <div class="bg-white/80 card-gradient rounded-2xl custom-shadow overflow-hidden transform hover:-translate-y-2 transition-all duration-300 course-card">
                            <div class="relative">
                                <img src="<?php echo $course['image_url'] ?>" alt="<?php echo $course['title'] ?>" class="w-full h-48 object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 text-gray-800"><?php echo $course['title'] ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo $course['content'] ?></p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <?php echo date('M d, Y', strtotime($course['created_at'])) ?>
                                    </span>
                                    <a href="/App/views/logIn.php" 
                                     class="px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors">
                                     Enroll Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <?php if (!empty($searchTerm)): ?>
                <div class="text-center py-20 bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200 shadow-lg course-card">
                    <i class="fas fa-book-open text-6xl text-gray-300 mb-4 animate-float"></i>
                    <p class="text-2xl text-gray-500">No results found for "<?php echo htmlspecialchars($searchTerm); ?>".</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>


    <div class="hero-bg min-h-[80vh] flex items-center justify-center text-white">
        <div class="max-w-7xl mx-auto px-6 py-32 text-center">
            <h1 class="text-6xl font-bold mb-8 leading-tight">
                Unlock Your Potential<br>
                <span class="text-indigo-400">Master New Skills</span>
            </h1>
            <p class="text-xl mb-12 max-w-2xl mx-auto text-gray-300">
                Join thousands of learners worldwide and transform your future with our expert-led courses.
            </p>
            <div class="flex justify-center space-x-6">
                <a href="/App/views/Register.php" 
                   class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full hover:shadow-xl transition-all duration-300 flex items-center">
                    <i class="fas fa-rocket mr-2"></i>
                    Start Learning
                </a>
                <a href="#courses" 
                   class="px-8 py-3 bg-white/10 rounded-full hover:bg-white/20 transition-all duration-300 backdrop-blur-sm flex items-center">
                    <i class="fas fa-play mr-2"></i>
                    Explore Courses
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20" id="courses">

        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold gradient-text mb-4">Featured Courses</h2>
                <p class="text-gray-600">Explore our most popular learning paths</p>
            </div>
            
            <div class="flex space-x-2">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <button onclick="showPage(<?= $i ?>)" 
                            class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 <?= $i === $page ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' ?>">
                        <?= $i ?>
                    </button>
                <?php endfor; ?>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (count($currentPageCourses) > 0): ?>
                <?php foreach ($currentPageCourses as $course): ?>
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden card-hover border border-gray-100">
                        <div class="relative">
                            <img src="<?= $course['image_url'] ?>" 
                                 alt="<?= $course['title'] ?>" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="category-pill px-4 py-1.5 rounded-full text-indigo-600 text-sm font-medium">
                                    <?= $course['category_name'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-3 hover:text-indigo-600 transition-colors">
                                <?= $course['title'] ?>
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-2">
                                <?= $course['content'] ?>
                            </p>
           
                            <div class="flex items-center mb-6">
                                <img src="<?= $course['profile_image'] ?>" 
                                     alt="<?= $course['username'] ?>" 
                                     class="w-12 h-12 rounded-full border-2 border-indigo-100">
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900"><?= $course['username'] ?></p>
                                    <p class="text-sm text-gray-500">Course Instructor</p>
                                </div>
                            </div>
           
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <?= date('M d, Y', strtotime($course['created_at'])) ?>
                                </span>
                                <a href="/App/views/logIn.php" 
                                   class="px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors">
                                    Enroll Now
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-16">
                    <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-500">No courses available at the moment.</p>
                    <p class="text-gray-400 mt-2">Please check back later for new courses.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include __DIR__.'/public/footer.php' ?>
    <script src="/public/script.js"></script>
</body>
</html>
