<?php

session_start();
require_once '../../../vendor/autoload.php';
$imageProfile = $_SESSION['user']['profile_image'];
$name = $_SESSION['user']['username'];
$Studentid = $_SESSION['user']['id'];

$courseController = new \App\Controllers\CourseController();

if (isset($_GET['readid']) && $_GET['action'] === 'read') {
    $ReadId = $_GET['readid']; 
    $courses = $courseController->getSpecificCourse($ReadId);
}
?>

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
            padding-bottom: 56.25%; 
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
        .nav-button {
            @apply px-4 py-2 rounded-lg transition-all duration-300 hover:scale-105;
        }
        .nav-button-primary {
            @apply gradient-bg text-white hover:shadow-lg;
        }
        .nav-button-secondary {
            @apply bg-gray-100 text-gray-700 hover:bg-gray-200;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo Section -->
                <div class="flex items-center space-x-2">
                    <div class="gradient-bg p-2 rounded-lg">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Youdemy</span>
                </div>

                <?php if($_SESSION['user']['role'] == 'student'): ?>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="Browse.php" class="nav-button nav-button-secondary flex items-center space-x-2">
                        <i class="fas fa-compass"></i>
                        <span>Browse Courses</span>
                    </a>
                    <a href="MesCours.php" class="nav-button nav-button-secondary flex items-center space-x-2">
                        <i class="fas fa-book-open"></i>
                        <span>My Courses</span>
                    </a>
                    <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-3">
                        <img src="<?php echo $imageProfile ?>" alt="Profile" class="w-10 h-10 rounded-full border-2 border-indigo-200 object-cover shadow-md">
                        <div class="hidden md:block">
                            <p class="font-medium text-gray-900"><?php echo $name ?></p>
                            <p class="text-sm text-gray-500">Student</p>
                        </div>
                        <a href="../LogOut.php" class="nav-button nav-button-primary flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
                </div>
                <?php elseif($_SESSION['user']['role'] == 'teacher'): ?>
                        <div class="hidden md:flex items-center space-x-4">
                        <a href="/App/views/teacher/seeCourses.php" class="nav-button nav-button-secondary flex items-center space-x-2">
                            
                            <span>back</span>
                        </a>
                        <a href="../LogOut.php" class="nav-button nav-button-secondary flex items-center space-x-2">
                            
                            <span>logOut</span>
                        </a>
                    </div>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
    </nav>

   
    <div class="relative">
   
        <div class="h-64 md:h-80 w-full overflow-hidden relative">
            <img src="<?php echo $courses['image_url'] ?>" alt="Course Banner" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        </div>

        <?php if($_SESSION['user']['role'] == 'student'): ?>
        <div class="absolute bottom-0 left-0 right-0">
            <div class="max-w-7xl mx-auto px-4 pb-8">
                <div class="text-white">
                    <h1 class="text-4xl font-bold mb-4 drop-shadow-lg"><?php echo $courses['title'] ?></h1>
                    <div class="flex flex-wrap items-center gap-6">
                        <div class="flex items-center space-x-2 bg-black/30 rounded-full px-4 py-2">
                            <i class="fas fa-calendar"></i>
                            <span>Created: <?php echo date('M d, Y', strtotime($courses['created_at'])) ?></span>
                        </div>
                        <div class="flex items-center space-x-2 bg-black/30 rounded-full px-4 py-2">
                            <i class="fas fa-user"></i>
                            <span>By <?php echo $courses['teacher_name'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl p-6 content-shadow hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Course Content</h2>
                    <div class="video-container mb-6">
                        <?php
                            if (filter_var($courses['description'], FILTER_VALIDATE_URL)) {
                                echo '<iframe src="' . $courses['description'] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                            } else {
                                echo '<p class="text-gray-600 leading-relaxed">' . nl2br($courses['description']) . '</p>';
                            }
                        ?>
                    </div>
                    <?php if($_SESSION['user']['role'] == 'student'): ?>
                        <div>
                            <p>have you finished the course ? click below </p>
                            <button onclick="downloadCertificate()" class="certificate-button flex items-center space-x-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl shadow-lg">
                                <i class="fas fa-certificate text-xl"></i>
                                <span class="font-semibold">Get Your Certificate</span>
                                <div class="relative">
                                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full"></div>
                                    <i class="fas fa-download"></i>
                                </div>
                        </button>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="bg-white rounded-2xl p-6 content-shadow hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Course Description</h2>
                    <p class="text-gray-600 leading-relaxed"><?php echo nl2br($courses['content']) ?></p>
                </div>

                <div class="bg-white rounded-2xl p-6 content-shadow hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Course Tags</h2>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach ($courses['tags'] as $tag): ?>
                            <span class="px-4 py-2 gradient-bg text-white rounded-full shadow-md hover:shadow-lg transition-shadow duration-300"><?php echo $tag ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
function downloadCertificate() {
    if (confirm('Congratulations on completing the course! Would you like to download your certificate?')) {
        const button = document.querySelector('.certificate-button');
        button.classList.add('scale-105', 'rotate-2');
        setTimeout(() => button.classList.remove('scale-105', 'rotate-2'), 300);

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });

        // Certificate data
        const username = '<?php echo $_SESSION["user"]["username"]; ?>';
        const courseTitle = '<?php echo $courses["title"]; ?>';
        const teacher = '<?php echo $courses['teacher_name'] ?>';
        const completionDate = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const certificateId = generateCertificateId();

        // Add decorative border
        doc.setDrawColor(70, 70, 220);
        doc.setLineWidth(2);
        doc.rect(15, 15, 267, 180);
        doc.setDrawColor(100, 100, 230);
        doc.setLineWidth(1);
        doc.rect(20, 20, 257, 170);

        // Add header decoration
        doc.setFillColor(70, 70, 220, 0.1);
        doc.rect(15, 15, 267, 40, 'F');

        // Add certificate title
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(40);
        doc.setTextColor(50, 50, 150);
        doc.text("Certificate of Completion", 148, 45, null, null, 'center');

        // Add decorative line under title
        doc.setLineWidth(0.5);
        doc.setDrawColor(70, 70, 220);
        doc.line(60, 55, 237, 55);

        // Add main content
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(20);
        doc.setTextColor(80, 80, 80);
        doc.text("This is to certify that", 148, 80, null, null, 'center');

        // Add student name
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(30);
        doc.setTextColor(50, 50, 150);
        doc.text(username, 148, 100, null, null, 'center');

        // Add course completion text
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(20);
        doc.setTextColor(80, 80, 80);
        doc.text("has successfully completed the course:", 148, 120, null, null, 'center');

        // Add course title
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(24);
        doc.setTextColor(50, 50, 150);
        doc.text(courseTitle, 148, 140, null, null, 'center');

        // Add completion date
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(16);
        doc.setTextColor(100, 100, 100);
        doc.text(`Completed on ${completionDate}`, 148, 160, null, null, 'center');

        // Add signature section
        doc.setDrawColor(200, 200, 200);
        doc.line(60, 170, 120, 170);
        doc.line(177, 170, 237, 170);

        doc.setFont('helvetica', 'normal');
        doc.setFontSize(12);
        doc.text("Course Instructor", 90, 180, null, null, 'center');

        doc.setFont('helvetica', 'bold');
        doc.setFontSize(30);
        doc.setTextColor(50, 50, 150);
        doc.text(teacher, 150, 180, null, null, 'center');

        // Save the certificate
        const fileName = `${username}_${courseTitle.replace(/\s+/g, '_')}_certificate.pdf`;
        doc.save(fileName);

        // Success notification
        showNotification('Certificate generated successfully!');
    }
}

// Helper function to generate certificate ID
function generateCertificateId() {
    const timestamp = Date.now().toString(36);
    const randomStr = Math.random().toString(36).substr(2, 5);
    return `YD-${timestamp}-${randomStr}`.toUpperCase();
}

// Helper function to show notification
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 translate-y-20 opacity-0';
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.remove('translate-y-20', 'opacity-0');
    }, 100);

    setTimeout(() => {
        notification.classList.add('translate-y-20', 'opacity-0');
        setTimeout(() => {
            notification.remove();
        }, 500);
    }, 3000);
}
</script>
</html>