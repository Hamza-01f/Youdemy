<?php
session_start();

require_once __DIR__.'/../../../vendor/autoload.php';

$id = $_SESSION['user']['id'];
$role = $_SESSION['user']['role'];

$courseController = new \App\Controllers\CourseController();
$search = new \App\Controllers\CourseController();

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($searchTerm)) {
    $searching = $search->search($id, $role, $searchTerm);
} 


$courses = $courseController->getCourses($id);

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
    <title>Youdemy - Student Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/../../../public/style.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <nav class="glass-effect w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-4">
                <a href="../index.php" class="flex items-center space-x-4 group">
                    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 p-2.5 rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-graduation-cap text-2xl text-white logo-spin"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                        Youdemy
                    </span>
                </a>
                </div>
                
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
        </div>
    </nav>

    <div class="searchingResults px-6 max-w-7xl mx-auto mt-24 mb-8 hidden">
        <?php if (!empty($searching)): ?>
            <div class="bg-green-200  backdrop-blur-sm p-8 rounded-2xl border border-gray-200 shadow-lg">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Search Results</h2>
                    <p class="text-gray-600">Found <?php echo count($searching); ?> courses matching your search</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($searching as $course): ?>
                        <div class="bg-white/80 card-gradient rounded-2xl custom-shadow overflow-hidden transform hover:-translate-y-2 transition-all duration-300 course-card">
                            <div class="relative">
                                <img src="<?php echo $course['image_url'] ?>" alt="<?php echo $course['title'] ?>" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 text-gray-800"><?php echo $course['title'] ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo $course['content'] ?></p>
                                <div class="flex items-center mb-6">
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <?php echo date('M d, Y', strtotime($course['created_at'])) ?>
                                    </span>
                                    <a href="/App/views/student/readCourse.php?readid=<?php echo $course['id'] ?>&action=read" 
                                      class="px-6 py-2.5 bg-gradient-to-r from-green-400 to-emerald-500 text-white rounded-xl hover:shadow-lg transition-all duration-300">
                                      <i class="fas fa-book-reader mr-2"></i>Review
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

    <div class="custom-gradient text-white pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to  Courses</h1>
            <p class="text-xl text-gray-100 max-w-2xl">Review the content of the courses! And make sure if everything goes well</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-16" id="courses">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                 Available Courses
            </h2>
            <div class="flex space-x-2">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <span onclick="showPage(<?php echo $i ?>)" 
                          class="w-10 h-10 flex items-center justify-center rounded-xl cursor-pointer transition-all duration-300 <?php echo $i === $page ? 'custom-gradient text-white shadow-lg' : 'bg-white text-indigo-600 hover:bg-indigo-50 border-2 border-indigo-600' ?>">
                        <?php echo $i ?>
                    </span>
                <?php endfor; ?>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (count($currentPageCourses) > 0): ?>
                <?php foreach ($currentPageCourses as $course): ?>
                    <div class="card-gradient rounded-2xl custom-shadow overflow-hidden transform hover:-translate-y-2 transition-all duration-300">
                        <div class="relative">
                            <img src="<?php echo $course['image_url'] ?>" alt="<?php echo $course['title'] ?>" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="px-4 py-2 glass-effect text-indigo-600 rounded-xl text-sm font-medium">
                                    <?php echo $course['category_name'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 text-gray-800"><?php echo $course['title'] ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-2"><?php echo $course['content'] ?></p>
                            <div class="flex items-center mb-6">
                                <img src="<?php echo $course['profile_image'] ?>" alt="Instructor" class="w-12 h-12 rounded-xl border-2 border-indigo-200">
                                <div class="ml-3">
                                    <p class="font-bold text-gray-800"><?php echo $course['username'] ?></p>
                                    <p class="text-sm text-indigo-500">Instructor</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <?php echo date('M d, Y', strtotime($course['created_at'])) ?>
                                </span>
                                <a href="/App/views/student/readCourse.php?readid=<?php echo $course['id'] ?>&action=read" 
                                   class="px-6 py-2.5 bg-gradient-to-r from-green-400 to-emerald-500 text-white rounded-xl hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-book-reader mr-2"></i>Review
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-20 bg-white rounded-2xl custom-shadow">
                    <i class="fas fa-book-open text-6xl text-gray-300 mb-4 animate-float"></i>
                    <p class="text-2xl text-gray-500">No courses available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
    <script src="/../../../public/script.js"></script>
</body>
</html>
