<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Script untuk SweetAlert (untuk notifikasi Lupa Password) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .animated-gradient {
            background-size: 200% 200%;
            animation: moveGradient 10s ease-in-out infinite;
        }
        @keyframes moveGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="antialiased bg-slate-100">
    <div class="flex items-center justify-center min-h-screen p-4">
        @yield('content')
    </div>
    
    {{-- SEMUA SCRIPT KITA SATUKAN DI SINI --}}
    <script>
        // Fungsi untuk ikon mata
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        // Fungsi untuk notifikasi Lupa Password
        function showForgotPasswordInfo() {
            Swal.fire({
                icon: 'info',
                title: 'Lupa Password?',
                html: 'Jika lupa password, silakan hubungi <b>Admin IT</b> di ruangan Anda.',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#1d4ed8' // Warna biru yang lebih sesuai
            });
        }
    </script>
</body>
</html>