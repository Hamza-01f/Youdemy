<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Statistiques des Cours</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-purple-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Youdemy Analytics</h1>
            <div class="space-x-4">
                        <a href="ManageCourses.php" class="text-gray-900 hover:text-blue-600 transition-colors duration-200 font-medium">Manage Courses</a>
                        <a href="AddCourse.php" class="text-gray-900 hover:text-blue-600 transition-colors duration-200 font-medium">Add Course</a>
                <span class="font-medium">Professeur: Jean Dupont</span>
                <button class="bg-purple-500 hover:bg-purple-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                </button>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">


        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Étudiants</p>
                        <p class="text-2xl font-bold text-gray-800">1,234</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Cours Actifs</p>
                        <p class="text-2xl font-bold text-gray-800">45</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-book text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-yellow-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Nombre d’étudiants inscrits </p>
                        <p class="text-2xl font-bold text-gray-800">78%</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-graduation-cap text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Cours non Actifs</p>
                        <p class="text-2xl font-bold text-gray-800">45</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-book text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
           
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Enrollment Trend -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Évolution des Inscriptions</h3>
                <canvas id="enrollmentChart" height="300"></canvas>
            </div>

            <!-- Course Performance -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Performance par Cours</h3>
                <canvas id="coursePerformanceChart" height="300"></canvas>
            </div>
        </div>

        <!-- Detailed Stats Table -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Détails par Cours</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700">Cours</th>
                            <th class="px-6 py-3 text-left text-gray-700">Inscrits</th>
                            <th class="px-6 py-3 text-left text-gray-700">Complétion</th>
                            <th class="px-6 py-3 text-left text-gray-700">Note</th>
                            <th class="px-6 py-3 text-left text-gray-700">Tendance</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">JavaScript Avancé</td>
                            <td class="px-6 py-4">256</td>
                            <td class="px-6 py-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">4.9/5</td>
                            <td class="px-6 py-4 text-green-500">↑ 12%</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">Python Débutant</td>
                            <td class="px-6 py-4">189</td>
                            <td class="px-6 py-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 72%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">4.7/5</td>
                            <td class="px-6 py-4 text-red-500">↓ 3%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
      
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Inscriptions',
                    data: [65, 78, 90, 85, 99, 112],
                    borderColor: 'rgb(147, 51, 234)',
                    tension: 0.3,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        const performanceCtx = document.getElementById('coursePerformanceChart').getContext('2d');
        new Chart(performanceCtx, {
            type: 'bar',
            data: {
                labels: ['JavaScript', 'Python', 'React', 'Node.js', 'HTML/CSS'],
                datasets: [{
                    label: 'Étudiants Actifs',
                    data: [256, 189, 156, 134, 178],
                    backgroundColor: 'rgba(147, 51, 234, 0.5)',
                    borderColor: 'rgb(147, 51, 234)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</body>
</html>