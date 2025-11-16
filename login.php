<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'Akeyla' && $password === 'TA4') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        header('Location: index.php');
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#ff9966',
                        'secondary': '#ffcc99',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        @keyframes slide-in {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        .float { animation: float 3s ease-in-out infinite; }
        .pulse-slow { animation: pulse-slow 2s ease-in-out infinite; }
        .slide-in { animation: slide-in 0.5s ease-out; }
        
        /* Particles background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: linear-gradient(135deg, #ff9966, #ffcc99);
            border-radius: 50%;
            opacity: 0.6;
            animation: float 6s ease-in-out infinite;
        }
        .particle:nth-child(1) { top: 10%; left: 20%; animation-delay: 0s; }
        .particle:nth-child(2) { top: 30%; left: 80%; animation-delay: 1s; }
        .particle:nth-child(3) { top: 70%; left: 10%; animation-delay: 2s; }
        .particle:nth-child(4) { top: 50%; left: 60%; animation-delay: 3s; }
        .particle:nth-child(5) { top: 80%; left: 90%; animation-delay: 4s; }
        .particle:nth-child(6) { top: 20%; left: 50%; animation-delay: 1.5s; }
        
        /* Cat walking animation */
        @keyframes cat-walk {
            0% { left: -120px; transform: scaleX(-1); }
            100% { left: calc(100% + 120px); transform: scaleX(-1); }
        }
        
        .cat-container {
            position: fixed;
            bottom: 20px;
            animation: cat-walk 15s linear infinite;
            z-index: 5;
            width: 100px;
            height: 100px;
        }
        
        .cat-gif {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-amber-50 to-stone-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Animated Particles Background -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    
    <!-- Walking Cat -->
    <div class="cat-container">
        <img src="https://bestanimations.com/Animals/Mammals/Cats/cats/cute-kitty-animated-gif-2.gif" alt="Walking Cat" class="cat-gif">
    </div>
    
    <!-- Decorative Circles -->
    <div class="fixed top-20 right-20 w-64 h-64 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pulse-slow"></div>
    <div class="fixed bottom-20 left-20 w-72 h-72 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pulse-slow" style="animation-delay: 1s;"></div>
    <div class="fixed top-1/2 left-1/2 w-80 h-80 bg-stone-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-slow" style="animation-delay: 2s;"></div>
    
    <div class="w-full max-w-md slide-in relative z-10">
        <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 relative">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-400 via-amber-400 to-orange-300 p-8 text-center relative overflow-hidden">
                <div class="w-20 h-20 bg-white rounded-full mx-auto mb-4 flex items-center justify-center shadow-xl float">
                    <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white drop-shadow-lg">Selamat Datang</h2>
                <p class="text-orange-50 mt-2 font-medium">Sistem Manajemen Kontak</p>
            </div>
            
            <!-- Form -->
            <div class="p-8 bg-gradient-to-br from-orange-50/50 to-amber-50/50">
                <?php if ($error): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md animate-bounce">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="font-medium"><?php echo $error; ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form method="POST" class="space-y-6">
                    <div class="relative">
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <span>👤 Username</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="username" name="username" value="Akeyla" required
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-200 transition-all shadow-sm hover:shadow-md">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-orange-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <span>🔐 Password</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" value="TA4" required
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all shadow-sm hover:shadow-md">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-amber-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-orange-400 via-amber-400 to-orange-300 text-white font-bold py-4 px-4 rounded-lg hover:from-orange-500 hover:via-amber-500 hover:to-orange-400 transform hover:scale-105 active:scale-95 transition-all duration-200 shadow-xl hover:shadow-2xl flex items-center justify-center gap-2">
                        <span>Masuk Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>
                
                <div class="mt-6 p-4 bg-gradient-to-r from-orange-100 via-amber-50 to-orange-100 rounded-lg border-2 border-orange-200 shadow-inner">
                    <p class="text-sm text-gray-700 text-center">
                        <span class="font-bold text-orange-600">💡 Info Login:</span><br>
                        <span class="inline-block mt-1">username: <span class="text-orange-600 font-mono font-bold px-2 py-1 rounded">Akeyla</span></span>
                        <span class="mx-2"></span>
                        <span class="inline-block">password: <span class="text-amber-600 font-mono font-bold px-2 py-1 rounded">TA4</span></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>