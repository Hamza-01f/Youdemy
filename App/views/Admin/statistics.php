<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>DevBlog Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-item {
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            transform: translateX(10px);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            transition: all 0.3s ease;
        }

        .chart-container:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen">
    <!-- Top Navigation -->
    <nav class="bg-gradient-to-r from-indigo-900 to-purple-900 text-white p-4 shadow-lg fixed w-full z-10 top-0 left-0">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fas fa-code text-2xl text-pink-500"></i>
                <h1 class="text-2xl font-extrabold bg-gradient-to-r from-pink-500 to-purple-500 text-transparent bg-clip-text">DevBlog Admin</h1>
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
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="stat-card bg-gradient-to-br from-pink-500 to-purple-600 p-6 rounded-2xl shadow-xl text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Total Users</h3>
                        <i class="fas fa-users text-3xl opacity-80"></i>
                    </div>
                    <p class="text-4xl font-bold mt-4">1,234</p>
                </div>

                <div class="stat-card bg-gradient-to-br from-indigo-500 to-blue-600 p-6 rounded-2xl shadow-xl text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Total Articles</h3>
                        <i class="fas fa-newspaper text-3xl opacity-80"></i>
                    </div>
                    <p class="text-4xl font-bold mt-4">856</p>
                </div>

                <div class="stat-card bg-gradient-to-br from-purple-500 to-pink-600 p-6 rounded-2xl shadow-xl text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Categories</h3>
                        <i class="fas fa-folder text-3xl opacity-80"></i>
                    </div>
                    <p class="text-4xl font-bold mt-4">32</p>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="chart-container bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Platform Statistics</h2>
                    <canvas id="platformStatsChart" class="w-full"></canvas>
                </div>

                <div class="chart-container bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Articles by Category</h2>
                    <canvas id="articlesByCategoryChart" class="w-full"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="chart-container bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Popular Tags</h2>
                    <canvas id="popularTagsChart" class="w-full"></canvas>
                </div>

                <div class="chart-container bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Top Authors</h2>
                    <canvas id="topAuthorsChart" class="w-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for demonstration
        const sampleData = {
            platformStats: {
                labels: ['Users', 'Articles', 'Categories'],
                data: [1234, 856, 32]
            },
            articlesByCategory: {
                labels: ['Technology', 'Design', 'Development', 'Business', 'Marketing'],
                data: [45, 32, 28, 24, 20]
            },
            popularTags: {
                labels: ['JavaScript', 'React', 'Python', 'Design', 'AI'],
                data: [150, 120, 100, 80, 60]
            },
            topAuthors: {
                labels: ['John Doe', 'Jane Smith', 'Mike Johnson'],
                data: [25, 20, 15]
            }
        };

        // Platform Stats Chart
        new Chart('platformStatsChart', {
            type: 'doughnut',
            data: {
                labels: sampleData.platformStats.labels,
                datasets: [{
                    data: sampleData.platformStats.data,
                    backgroundColor: ['#EC4899', '#6366F1', '#8B5CF6'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Articles by Category Chart
        new Chart('articlesByCategoryChart', {
            type: 'bar',
            data: {
                labels: sampleData.articlesByCategory.labels,
                datasets: [{
                    label: 'Number of Articles',
                    data: sampleData.articlesByCategory.data,
                    backgroundColor: '#8B5CF6',
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

        // Popular Tags Chart
        new Chart('popularTagsChart', {
            type: 'pie',
            data: {
                labels: sampleData.popularTags.labels,
                datasets: [{
                    data: sampleData.popularTags.data,
                    backgroundColor: ['#EC4899', '#6366F1', '#8B5CF6', '#14B8A6', '#F59E0B'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Top Authors Chart
        new Chart('topAuthorsChart', {
            type: 'bar',
            data: {
                labels: sampleData.topAuthors.labels,
                datasets: [{
                    label: 'Articles Published',
                    data: sampleData.topAuthors.data,
                    backgroundColor: '#6366F1',
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