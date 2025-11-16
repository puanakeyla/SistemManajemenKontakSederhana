<?php
require_once 'config.php';
checkAuth();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kontak</title>
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
        .particle:nth-child(1) { top: 10%; left: 10%; width: 6px; height: 6px; }
        .particle:nth-child(2) { top: 20%; left: 80%; width: 10px; height: 10px; }
        .particle:nth-child(3) { top: 60%; left: 20%; }
        .particle:nth-child(4) { top: 40%; left: 70%; width: 7px; height: 7px; }
        .particle:nth-child(5) { top: 80%; left: 50%; width: 9px; height: 9px; }
        .particle:nth-child(6) { top: 30%; left: 40%; }
        .particle:nth-child(7) { top: 70%; left: 90%; width: 6px; height: 6px; }
        .particle:nth-child(8) { top: 50%; left: 15%; width: 8px; height: 8px; }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 via-amber-50 to-stone-50 min-h-screen relative">
    <!-- Animated Particles Background -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    
    <!-- Decorative Blurred Circles -->
    <div class="fixed top-20 right-10 w-96 h-96 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-slow" style="z-index: 0;"></div>
    <div class="fixed bottom-20 left-10 w-80 h-80 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pulse-slow" style="animation-delay: 1.5s; z-index: 0;"></div>
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-10 pulse-slow" style="animation-delay: 3s; z-index: 0;"></div>
    
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-orange-400 via-amber-400 to-orange-300 shadow-2xl relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-5">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white drop-shadow-lg">Sistem Manajemen Kontak</h1>
                </div>
                <div class="flex gap-3">
                    <a href="add-contact.php" class="bg-white text-orange-600 px-5 py-2 rounded-lg font-semibold hover:bg-orange-50 transform hover:scale-105 transition-all duration-200 shadow-md flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Kontak
                    </a>
                    <a href="logout.php" class="bg-red-500 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-600 transform hover:scale-105 transition-all duration-200 shadow-md flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        <!-- User Info Card -->
        <div class="bg-gradient-to-r from-orange-100 via-amber-50 to-orange-100 rounded-xl shadow-lg p-6 mb-6 border-l-4 border-orange-500 slide-in backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-amber-500 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-700">Selamat datang, <strong class="text-orange-600"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
                    <p class="text-sm text-gray-600">Login: <?php echo $_SESSION['login_time']; ?></p>
                </div>
            </div>
        </div>

        <!-- Contacts Section -->
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden slide-in" style="animation-delay: 0.2s;">
            <div class="bg-gradient-to-r from-orange-400 via-amber-400 to-orange-300 px-6 py-5 flex items-center gap-3">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h2 class="text-2xl font-bold text-white drop-shadow-md">Daftar Kontak</h2>
            </div>
            
            <div class="p-6">
                <?php
                $contacts = readContacts();
                
                if (empty($contacts)) {
                    echo '<div class="text-center py-16">';
                    echo '<svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                    echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>';
                    echo '</svg>';
                    echo '<p class="text-xl text-gray-500 mb-4">Belum ada kontak</p>';
                    echo '<a href="add-contact.php" class="inline-block bg-gradient-to-r from-orange-400 to-amber-400 text-white px-6 py-3 rounded-lg font-semibold hover:from-orange-500 hover:to-amber-500 transform hover:scale-105 transition-all duration-200">Tambah Kontak Pertama</a>';
                    echo '</div>';
                } else {
                    echo '<div class="overflow-x-auto">';
                    echo '<table class="w-full">';
                    echo '<thead>';
                    echo '<tr class="bg-gradient-to-r from-orange-100 to-amber-100">';
                    echo '<th class="px-6 py-4 text-left text-sm font-bold text-gray-700">No</th>';
                    echo '<th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Nama</th>';
                    echo '<th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Email</th>';
                    echo '<th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Telepon</th>';
                    echo '<th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Alamat</th>';
                    echo '<th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Aksi</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody class="divide-y divide-gray-200">';
                    
                    $no = 1;
                    foreach ($contacts as $id => $contact) {
                        echo '<tr class="hover:bg-orange-50 transition-colors">';
                        echo '<td class="px-6 py-4 text-gray-700">' . $no++ . '</td>';
                        echo '<td class="px-6 py-4 font-semibold text-gray-800">' . htmlspecialchars($contact['name']) . '</td>';
                        echo '<td class="px-6 py-4 text-gray-600">' . htmlspecialchars($contact['email']) . '</td>';
                        echo '<td class="px-6 py-4 text-gray-600">' . htmlspecialchars($contact['phone']) . '</td>';
                        echo '<td class="px-6 py-4 text-gray-600">' . htmlspecialchars($contact['address']) . '</td>';
                        echo '<td class="px-6 py-4 text-center">';
                        echo '<div class="flex gap-2 justify-center">';
                        echo '<a href="edit-contact.php?id=' . $id . '" class="bg-amber-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-amber-600 transform hover:scale-105 transition-all duration-200 inline-flex items-center gap-1">';
                        echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>';
                        echo 'Edit</a>';
                        echo '<a href="delete-contact.php?id=' . $id . '" onclick="return confirm(\'Yakin hapus kontak ini?\')" class="bg-red-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-600 transform hover:scale-105 transition-all duration-200 inline-flex items-center gap-1">';
                        echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>';
                        echo 'Hapus</a>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>