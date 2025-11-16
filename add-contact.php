<?php
require_once 'config.php';
checkAuth();

$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi dan sanitasi
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    
    // Validasi nama
    if (empty($name)) {
        $errors['name'] = 'Nama harus diisi';
    } elseif (!preg_match("/^[a-zA-Z\s\.]+$/", $name)) {
        $errors['name'] = 'Nama hanya boleh mengandung huruf, spasi, dan titik';
    } else {
        $data['name'] = $name;
    }
    
    // Validasi email
    if (empty($email)) {
        $errors['email'] = 'Email harus diisi';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid';
    } else {
        $data['email'] = $email;
    }
    
    // Validasi telepon
    if (empty($phone)) {
        $errors['phone'] = 'Telepon harus diisi';
    } elseif (!preg_match("/^[0-9+\-\s\(\)]+$/", $phone)) {
        $errors['phone'] = 'Format telepon tidak valid';
    } else {
        $data['phone'] = $phone;
    }
    
    // Validasi alamat
    if (empty($address)) {
        $errors['address'] = 'Alamat harus diisi';
    } else {
        $data['address'] = $address;
    }
    
    // Jika tidak ada error, simpan data
    if (empty($errors)) {
        $contacts = readContacts();
        $id = uniqid();
        $contacts[$id] = $data;
        saveContacts($contacts);
        
        header('Location: index.php?success=1');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kontak - Sistem Manajemen Kontak</title>
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
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        @keyframes slide-in {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
        .slide-in { animation: slide-in 0.6s ease-out; }
        
        /* Particles background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #ff9966, #ffcc99);
            border-radius: 50%;
            opacity: 0.4;
        }
        .particle:nth-child(1) { top: 15%; left: 10%; width: 6px; height: 6px; }
        .particle:nth-child(2) { top: 25%; left: 85%; width: 10px; height: 10px; }
        .particle:nth-child(3) { top: 55%; left: 15%; width: 7px; height: 7px; }
        .particle:nth-child(4) { top: 75%; left: 80%; width: 9px; height: 9px; }
        .particle:nth-child(5) { top: 40%; left: 50%; width: 8px; height: 8px; }
        .particle:nth-child(6) { top: 65%; left: 30%; width: 6px; height: 6px; }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-amber-50 to-stone-50 min-h-screen py-8 relative">
    <!-- Animated Particles Background -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    
    <!-- Decorative Blurred Circles -->
    <div class="fixed top-10 right-10 w-80 h-80 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-slow" style="z-index: 0;"></div>
    <div class="fixed bottom-10 left-10 w-72 h-72 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-slow" style="animation-delay: 1.5s; z-index: 0;"></div>
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-15 pulse-slow" style="animation-delay: 3s; z-index: 0;"></div>
    
    <div class="max-w-2xl mx-auto px-4 relative z-10">
        <!-- Header Card -->
        <div class="bg-white/95 backdrop-blur-sm rounded-t-2xl shadow-2xl overflow-hidden slide-in">
            <div class="bg-gradient-to-r from-orange-400 via-amber-400 to-orange-300 p-8">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-xl">
                        <svg class="w-9 h-9 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white drop-shadow-lg">Tambah Kontak Baru</h2>
                        <p class="text-orange-50 mt-1 font-medium">Isi formulir di bawah ini</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Card -->
        <div class="bg-white/95 backdrop-blur-sm rounded-b-2xl shadow-2xl p-8 slide-in" style="animation-delay: 0.15s;">
            <form method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Nama Lengkap</span>
                    </label>
                    <input type="text" id="name" name="name" 
                           value="<?php echo isset($data['name']) ? htmlspecialchars($data['name']) : ''; ?>" 
                           required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-200 transition-all shadow-sm hover:shadow-md <?php echo isset($errors['name']) ? 'border-red-500' : ''; ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div class="flex items-center gap-2 mt-2 text-red-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm"><?php echo $errors['name']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Email</span>
                    </label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo isset($data['email']) ? htmlspecialchars($data['email']) : ''; ?>" 
                           required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all shadow-sm hover:shadow-md <?php echo isset($errors['email']) ? 'border-red-500' : ''; ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div class="flex items-center gap-2 mt-2 text-red-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm"><?php echo $errors['email']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Telepon</span>
                    </label>
                    <input type="text" id="phone" name="phone" 
                           value="<?php echo isset($data['phone']) ? htmlspecialchars($data['phone']) : ''; ?>" 
                           required
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-200 transition-all shadow-sm hover:shadow-md <?php echo isset($errors['phone']) ? 'border-red-500' : ''; ?>">
                    <?php if (isset($errors['phone'])): ?>
                        <div class="flex items-center gap-2 mt-2 text-red-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm"><?php echo $errors['phone']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="address" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Alamat</span>
                    </label>
                    <textarea id="address" name="address" rows="4" required
                              class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-200 transition-all shadow-sm hover:shadow-md resize-none <?php echo isset($errors['address']) ? 'border-red-500' : ''; ?>"><?php echo isset($data['address']) ? htmlspecialchars($data['address']) : ''; ?></textarea>
                    <?php if (isset($errors['address'])): ?>
                        <div class="flex items-center gap-2 mt-2 text-red-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm"><?php echo $errors['address']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-orange-400 via-amber-400 to-orange-300 text-white font-bold py-4 px-6 rounded-lg hover:from-orange-500 hover:via-amber-500 hover:to-orange-400 transform hover:scale-105 active:scale-95 transition-all duration-200 shadow-xl hover:shadow-2xl flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Kontak
                    </button>
                    <a href="index.php" 
                       class="flex-1 bg-gray-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-600 transform hover:scale-105 transition-all duration-200 shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>