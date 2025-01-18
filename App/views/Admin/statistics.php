<?php

session_start();

require_once __DIR__ . '/../../Models/Statistics.php';

use App\Models\Statistics;

$statisticsModel = new Statistics();

$stats = $statisticsModel->getGeneralStats();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/../../../public/style.css">
    <title>Youdemy Admin</title>
    <style>

    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen">
    <!-- Top Navigation -->
    <nav class="bg-gradient-to-r from-indigo-900 to-purple-900 text-white p-4 shadow-lg fixed w-full z-10 top-0 left-0">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fas fa-code text-2xl text-pink-500"></i>
                <h1 class="text-2xl font-extrabold bg-gradient-to-r from-pink-500 to-purple-500 text-transparent bg-clip-text">Youdemy Admin</h1>
            </div>
            <a href="../LogOut.php" class="flex items-center space-x-2 bg-gradient-to-r from-pink-600 to-purple-600 px-6 py-2 rounded-full hover:from-pink-700 hover:to-purple-700 transition-all duration-300 shadow-md">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <div class="flex min-h-screen pt-16">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-indigo-900 to-purple-900 text-white w-72 p-6 shadow-xl">
            <div class="text-center mb-8">
                <div class="text-3xl font-extrabold bg-gradient-to-r from-pink-500 to-purple-500 text-transparent bg-clip-text">Dashboard</div>
            </div>
            <nav class="space-y-6">
                <a href="category.php" class="nav-item flex items-center text-lg group p-3 rounded-lg hover:bg-white/10">
                    <i class="fas fa-cogs mr-3 text-pink-400 group-hover:text-pink-300"></i>
                    <span class="group-hover:text-pink-300">Categories</span>
                </a>
                <a href="tag.php" class="nav-item flex items-center text-lg group p-3 rounded-lg hover:bg-white/10">
                    <i class="fas fa-tags mr-3 text-pink-400 group-hover:text-pink-300"></i>
                    <span class="group-hover:text-pink-300">Tags</span>
                </a>
                <a href="validation.php" class="nav-item flex items-center text-lg group p-3 rounded-lg hover:bg-white/10">
                    <i class="fas fa-users mr-3 text-pink-400 group-hover:text-pink-300"></i>
                    <span class="group-hover:text-pink-300">Users</span>
                </a>
                <a href="seecourses.php" class="nav-item flex items-center text-lg group p-3 rounded-lg hover:bg-white/10">
                    <i class="fas fa-newspaper mr-3 text-pink-400 group-hover:text-pink-300"></i>
                    <span class="group-hover:text-pink-300">Browse Courses</span>
                </a>
                <a href="/App/views/teacher/ManageCourses.php" class="nav-item flex items-center text-lg group p-3 rounded-lg hover:bg-white/10">
                    <i class="fas fa-book-open mr-2 text-pink-400 group-hover:text-pink-300"></i>
                    <span class="group-hover:text-pink-300">Courses</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="stat-card bg-gradient-to-br from-pink-500 to-purple-600 p-6 rounded-2xl shadow-xl text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Total Active Courses</h3>
                        <i class="fas fa-book text-3xl opacity-80"></i>
                    </div>
                    <p class="text-4xl font-bold mt-4"><?= $stats['active_courses'] ?></p>
                </div>
                <div class="stat-card bg-gradient-to-br from-indigo-500 to-blue-600 p-6 rounded-2xl shadow-xl text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Total Enrolled Students</h3>
                        <i class="fas fa-users text-3xl opacity-80"></i>
                    </div>
                    <p class="text-4xl font-bold mt-4"><?= $stats['total_students'] ?></p>
                </div>

                <div class="stat-card bg-gradient-to-br from-purple-500 to-pink-600 p-6 rounded-2xl shadow-xl text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Total Teachers</h3>
                        <i class="fas fa-chalkboard-teacher text-3xl opacity-80"></i>
                    </div>
                    <p class="text-4xl font-bold mt-4"><?= $stats['total_teachers'] ?></p>
                </div>

                <div class="stat-card bg-gradient-to-br from-yellow-500 to-orange-600 p-6 rounded-2xl shadow-xl text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Total Categories</h3>
                        <i class="fas fa-th-list text-3xl opacity-80"></i>
                    </div>
                    <p class="text-4xl font-bold mt-4"><?= $stats['total_categories'] ?></p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Doughnut Chart for General Stats -->
                <div class="chart-container bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">General Stats</h2>
                    <canvas id="generalStatsChart" class="w-full"></canvas>
                </div>

                <div class="chart-container bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Courses by Category</h2>
                    <canvas id="coursesByCategoryChart" class="w-full"></canvas>
                </div>
            </div>

        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
    <script>

    const generalStatsData = {
        labels: ['Active Courses', 'Enrolled Students', 'Teachers', 'Categories'],
        datasets: [{
            label: 'General Stats',
            data: [
                <?= isset($stats['active_courses']) ? $stats['active_courses'] : 0 ?>,
                <?= isset($stats['total_students']) ? $stats['total_students'] : 0 ?>,
                <?= isset($stats['total_teachers']) ? $stats['total_teachers'] : 0 ?>,
                <?= isset($stats['total_categories']) ? $stats['total_categories'] : 0 ?>
            ],
            backgroundColor: ['#6366F1', '#EC4899', '#F59E0B', '#34D399'],
            hoverOffset: 4
        }]
    };

    new Chart('generalStatsChart', {
        type: 'bar', 
        data: generalStatsData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const coursesByCategoryData = <?= isset($stats['coursesByCategory']) ? json_encode($stats['coursesByCategory']) : '[]' ?>;
    const courseCategories = coursesByCategoryData.map(item => item.category);
    const courseCounts = coursesByCategoryData.map(item => item.count);

    
    new Chart('coursesByCategoryChart', {
        type: 'bar',
        data: {
            labels: courseCategories,
            datasets: [{
                label: 'Courses by Category',
                data: courseCounts,
                backgroundColor: '#4F46E5',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
