<?php

require_once __DIR__.'/../../../vendor/autoload.php';
use App\Models\Statistics;

session_start();
$teacherId = $_SESSION['user']['id']; 


$statistics = new Statistics();


$statisticsData = $statistics->getData($teacherId);

$activeCourses = $statisticsData['activeCourses'];
$enrolledStudents = $statisticsData['enrolledStudents'];
$enrollmentTrend = $statisticsData['enrollmentTrend'];
$coursePerformance = $statisticsData['coursePerformance'];




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Analytics Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #6366F1 0%, #A855F7 100%);
        }
        .gradient-bg-2 {
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.1);
        }
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #6366F1;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }
        .chart-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <div class="gradient-bg p-2.5 rounded-xl">
                        <i class="fas fa-chart-line text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Youdemy Analytics
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="seeCourses.php" class="nav-link text-gray-700 hover:text-indigo-600 font-medium">
                        <i class="fas fa-books mr-2"></i>My Courses
                    </a>
                    <a href="ManageCourses.php" class="nav-link text-gray-700 hover:text-indigo-600 font-medium">
                        <i class="fas fa-cog mr-2"></i>Manage Courses
                    </a>
                    <a href="AddCourse.php" class="nav-link text-gray-700 hover:text-indigo-600 font-medium">
                        <i class="fas fa-plus-circle mr-2"></i>Add Course
                    </a>
                    <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full font-medium">
                        <i class="fas fa-user mr-2"></i><?php echo $_SESSION['user']['username']; ?>
                    </span>
                    <a href="logout.php" class="px-6 py-2.5 gradient-bg text-white rounded-full hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Statistics Cards -->
        <div class="stats-grid mb-8">
            <!-- Active Courses Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-indigo-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Active Courses</p>
                        <p class="text-3xl font-bold text-indigo-600"><?php echo $activeCourses; ?></p>
                    </div>
                    <div class="gradient-bg p-4 rounded-xl">
                        <i class="fas fa-book-open text-white text-2xl"></i>
                    </div>
                </div>

            </div>

       
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-purple-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Enrolled Students</p>
                        <p class="text-3xl font-bold text-purple-600">
                            <?php echo $enrolledStudents; ?>
                            <span class="text-sm font-normal text-gray-500">
                                (<?php echo round(($enrolledStudents / 100) * 78); ?>%)
                            </span>
                        </p>
                    </div>
                    <div class="gradient-bg-2 p-4 rounded-xl">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                </div>

            </div>
        </div>

    
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
           
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-indigo-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-chart-line text-indigo-600 mr-2"></i>
                        Enrollment Trend
                    </h3>
                    <div class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-sm">
                        Last 30 Days
                    </div>
                </div>
                <canvas id="enrollmentChart" height="300"></canvas>
            </div>

           
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-purple-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-chart-bar text-purple-600 mr-2"></i>
                        Course Performance
                    </h3>
                    <div class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm">
                        All Courses
                    </div>
                </div>
                <canvas id="coursePerformanceChart" height="300"></canvas>
            </div>
        </div>
    </main>
    <?php include __DIR__.'/../../../public/footer.php' ?>
    <script>
      
        const enrollmentTrendData = <?php echo json_encode($enrollmentTrend); ?>;
        const enrollmentLabels = enrollmentTrendData.map(item => item.date);
        const enrollmentValues = enrollmentTrendData.map(item => item.count);

        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: enrollmentLabels,
                datasets: [{
                    label: 'Daily Enrollments',
                    data: enrollmentValues,
                    borderColor: '#6366F1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#6366F1',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: true, color: 'rgba(0, 0, 0, 0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        const coursePerformanceData = <?php echo json_encode($coursePerformance); ?>;
        const courseTitles = coursePerformanceData.map(item => item.title);
        const courseStudents = coursePerformanceData.map(item => item.students);

        const performanceCtx = document.getElementById('coursePerformanceChart').getContext('2d');
        new Chart(performanceCtx, {
            type: 'bar',
            data: {
                labels: courseTitles,
                datasets: [{
                    label: 'Enrolled Students',
                    data: courseStudents,
                    backgroundColor: 'rgba(168, 85, 247, 0.2)',
                    borderColor: '#A855F7',
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(168, 85, 247, 0.3)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: true, color: 'rgba(0, 0, 0, 0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>