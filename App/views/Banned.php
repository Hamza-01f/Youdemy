<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Banned - Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }
        .pattern-bg {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%234f46e5' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .nav-button {
            @apply px-6 py-2.5 rounded-full transition-all duration-300 font-medium text-sm;
        }
        .nav-button.danger {
            @apply bg-red-600 text-white hover:bg-red-700 hover:shadow-lg;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="pattern-bg min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
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
                    <a href="/App/views/logOut.php" class="nav-button danger">
                        <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-2xl w-full bg-white rounded-2xl shadow-xl p-8 md:p-12 text-center relative overflow-hidden">
            <!-- Warning Icon -->
            <div class="mb-8 float-animation">
                <i class="fas fa-user-lock text-6xl md:text-7xl text-red-500"></i>
            </div>
            
            <!-- Message -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Account Suspended</h1>
            <p class="text-lg text-gray-600 mb-8">
                We're sorry, but your account has been suspended by our administrators. If you believe this is a mistake, please contact our support team.
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                <a href="mailto:support@youdemy.com" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition-colors duration-300">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Support
                </a>
                <a href="/App/views/logOut.php" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Return to Homepage
                </a>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-col items-center text-gray-500">
                    <p class="mb-2">Need immediate assistance?</p>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="hover:text-indigo-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="hover:text-indigo-600 transition-colors">
                            <i class="fab fa-discord"></i>
                        </a>
                        <span class="text-gray-300">|</span>
                        <span>
                            <i class="fas fa-phone-alt mr-2"></i>
                            +1 (555) 123-4567
                        </span>
                    </div>
                </div>
            </div>

            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-100 rounded-full -mr-16 -mt-16 opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-red-100 rounded-full -ml-12 -mb-12 opacity-50"></div>
        </div>
    </div>
    <?php include __DIR__.'/../../../public/footer.php' ?>
</body>
</html>