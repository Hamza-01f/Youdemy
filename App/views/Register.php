<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Join Our Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f01941449c.js" crossorigin="anonymous"></script>

    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .animated-gradient {
            background: linear-gradient(-45deg, #FF6B6B, #FF8E53, #FF62A5, #FF7EB3);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .input-icon {
            transition: all 0.3s ease;
        }

        .form-input:focus + .input-icon {
            color: #FF62A5;
        }
    </style>
</head>

<body class="font-poppins">
    <div class="min-h-screen animated-gradient flex items-center justify-center p-4">
        <div class="max-w-xl w-full glass-effect rounded-2xl shadow-2xl p-8 floating">
        
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-pink-500 via-orange-400 to-red-500 bg-clip-text text-transparent">
                    Join Our Courses
                </h2>
                <p class="mt-2 text-gray-600">Start your journey of endless knowledge</p>
            </div>

            <form method="POST"  class="form space-y-6" action="/App/Controllers/userController.php"  onsubmit="return validateForm(this)">
                <div class="relative">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-user"></i>
                        </span>
                        <input 
                            type="text"
                            id="username"
                            name="username"
                            class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500
                                transition-all duration-300"
                            placeholder="Choose a username"
                        />
                    </div>
                    <p id="usernameError" class="text-sm text-red-600 mt-1"></p>
                </div>

                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input 
                            type="email"
                            id="email"
                            name="email"
                            class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500
                                transition-all duration-300"
                            placeholder="Enter your email"
                        />
                    </div>
                    <p id="emailError" class="text-sm text-red-600 mt-1"></p>
                </div>

                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input 
                            type="password"
                            id="password"
                            name="password"
                            class="form-input block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500
                                transition-all duration-300"
                            placeholder="Create a password"
                        />
                        <button 
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer"
                        >
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p id="passwordError" class="text-sm text-red-600 mt-1"></p>
                </div>

                <div class="relative">
                    <label for="profile-picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                    <div class="flex items-center space-x-4">
                        <div id="image-preview" class="h-16 w-16 rounded-full bg-gradient-to-r from-pink-400 to-orange-300 flex items-center justify-center shadow-lg transition-all duration-300">
                            <span class="text-white"><i class="fas fa-camera text-xl"></i></span>
                        </div>
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-link"></i>
                            </span>
                            <input
                                type="url"
                                id="profile-picture"
                                name="photo"
                                placeholder="Enter image URL"
                                class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-700
                                    focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500
                                    transition-all duration-300"
                                oninput="previewImage(this)"
                            />
                        </div>
                    </div>
                    <p id="profilePictureError" class="text-sm text-red-600 mt-1"></p>
                </div>

                <!-- Role selection dropdown -->
                <div class="relative">
                   <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                  <div class="relative">
                        <span class="absolute top-3 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-pen"></i>
                        </span>
                        <textarea
                            id="bio"
                            name="bio"
                            rows="3"
                            class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500
                                transition-all duration-300"
                            placeholder="Tell us about yourself..."
                        ></textarea>
                    </div>
                    <p id="bioError" class="text-sm text-red-600 mt-1"></p>
                </div>

                <div class="relative">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select
                        id="role"
                        name="role"
                        class="form-input block w-full py-3 border border-gray-300 rounded-xl text-gray-700
                            focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500
                            transition-all duration-300"
                    >
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                    <p id="roleError" class="text-sm text-red-600 mt-1"></p>
                </div>

                <button 
                    type="submit"
                    name="Register"
                    class="w-full py-3 px-4 rounded-xl text-white font-semibold
                        bg-gradient-to-r from-pink-500 via-orange-400 to-red-500
                        hover:opacity-90 transform transition-all duration-300 hover:scale-105
                        focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2"
                >
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    Create Account
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="LogIn.php" 
                   class="text-pink-600 hover:text-pink-500 transition-colors duration-300 flex items-center justify-center gap-2">
                    <span>Already have an account?</span>
                    <span class="font-semibold hover:underline">Sign in here</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
                <p class="mt-4 text-sm text-gray-500">
                    Join our community of courses and gain knowledge! 📚✨
                </p>
            </div>
        </div>
    </div>
    <script>
        // const usernameRegex = /^\w{4,20}$/;  
        // const emailRegex = /^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/;  
        // const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d).{6,20}$/; 
        // const urlRegex = /^https:\/\/.*\.(jpg|jpeg|png|gif)$/;

        // function validateForm(form) {
        //     let isValid = true;

        //     const errorMessages = form.querySelectorAll('.text-red-600');
        //     errorMessages.forEach(error => error.textContent = '');

        //     const inputs = form.querySelectorAll('input, textarea, select');
        //     inputs.forEach(input => {
        //         let errorMessageElement = document.getElementById(input.id + 'Error');
        //         if (!input.value) {
        //             errorMessageElement.textContent = 'This field is required';
        //             isValid = false;
        //         } else if (input.name === 'username' && !usernameRegex.test(input.value)) {
        //             errorMessageElement.textContent = 'Username must be 4-20 characters and can include letters, numbers, and underscores.';
        //             isValid = false;
        //         } else if (input.name === 'email' && !emailRegex.test(input.value)) {
        //             errorMessageElement.textContent = 'Please enter a valid email address.';
        //             isValid = false;
        //         } else if (input.name === 'password' && !passwordRegex.test(input.value)) {
        //             errorMessageElement.textContent = 'Password must be 6-20 characters long, with at least one number, one lowercase letter, and one uppercase letter.';
        //             isValid = false;
        //         } else if (input.name === 'photo' && !urlRegex.test(input.value)) {
        //             errorMessageElement.textContent = 'Please enter a valid image URL (PNG, JPG, JPEG, GIF only).';
        //             isValid = false;
        //         }
        //     });

        //     return isValid;
        // }

        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const fileURL = input.value;
            if (fileURL) {
                preview.style.backgroundImage = `url(${fileURL})`;
                preview.style.backgroundSize = 'cover';
                preview.style.backgroundPosition = 'center';
                preview.querySelector('span').style.display = 'none';
            } else {
                preview.style.backgroundImage = 'none';
                preview.style.backgroundColor = '';
                preview.querySelector('span').style.display = 'block';
            }
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
