<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../LogIn.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Pending - Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .card-shine {
            background: linear-gradient(
                135deg,
                rgba(255,255,255,0.1) 0%,
                rgba(255,255,255,0.05) 50%,
                rgba(255,255,255,0) 100%
            );
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                <a href="../index.php" class="flex items-center space-x-4 group">
                    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 p-2.5 rounded-xl shadow-lg group-hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-graduation-cap text-2xl text-white logo-spin"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 bg-clip-text text-transparent">
                        Youdemy
                    </span>
                </a>
                </div>
                <div class="flex items-center">
                    <a href="../LogOut.php" 
                       class="inline-flex items-center px-6 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200 ease-in-out">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Top Gradient Banner -->
            <div class="gradient-bg h-32 relative">
                <div class="absolute inset-0 card-shine"></div>
                <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                    <div class="bg-white rounded-full p-4 shadow-lg">
                        <div class="gradient-bg rounded-full p-4">
                            <i class="fas fa-chalkboard-teacher text-4xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="pt-20 pb-12 px-6 sm:px-12">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        Welcome to Your Teaching Journey! Mr <?php echo $_SESSION['user']['username'] ?>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        We're excited to have you as a potential teacher on our platform.
                    </p>

                    <!-- Status Card -->
                    <div class="bg-blue-50 rounded-xl p-6 mb-8 inline-block">
                        <div class="animate-float mb-4">
                            <i class="fas fa-hourglass-half text-4xl text-blue-500"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-blue-900 mb-2">
                            Application Under Review
                        </h2>
                        <p class="text-blue-700">
                            Your request to become a teacher is being verified by our admin team.
                        </p>
                    </div>

                    <!-- Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left mb-8">
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-clock text-purple-500 text-xl mr-3"></i>
                                <h3 class="text-lg font-semibold text-gray-900">What's Next?</h3>
                            </div>
                            <p class="text-gray-600">
                                Our team will review your application and credentials. This usually takes 1-2 business days.
                            </p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-envelope text-purple-500 text-xl mr-3"></i>
                                <h3 class="text-lg font-semibold text-gray-900">Notification</h3>
                            </div>
                            <p class="text-gray-600">
                                You'll receive an email notification once your application is approved.
                            </p>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="border-t border-gray-200 pt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Need Help?
                        </h3>
                        <p class="text-gray-600 mb-4">
                            If you have any questions about your application, feel free to contact our support team.
                        </p>
                        <a href="mailto:support@youdemy.com" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-500 transition-colors duration-200">
                            <i class="fas fa-envelope mr-2"></i>
                            support@youdemy.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
</body>
</html>