<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mix Yoga</title>
    <!-- Integrasi Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-gray-100 p-4 relative flex items-center shadow-md">
        <!-- Sidebar Trigger di Kiri -->
        <div class="absolute left-4">
            <button id="sidebarToggle" class="text-gray-600">
                <!-- Icon Tiga Garis -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    
        <!-- Logo di Tengah -->
        <div class="flex-1 flex justify-center">
            <img src="{{ asset('public/images/logo-mix-yoga.jpg') }}" alt="Mix Yoga Logo" class="h-16">
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content') <!-- Section untuk konten halaman -->
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 p-4 text-center flex justify-between items-center">
        <!-- Privacy Policy -->
        <a href="{{ route('privacy.policy') }}" class="text-blue-500 hover:underline">Privacy Policy</a>
        <!-- Contact -->
        <a href="https://wa.me/6281234567890" class="text-blue-500 hover:underline" target="_blank">Contact</a>
    </footer>

    <script>
        // JavaScript untuk sidebar toggle (opsional)
        const sidebarToggle = document.getElementById('sidebarToggle');
        sidebarToggle.addEventListener('click', () => {
            alert('Sidebar toggle clicked! Implementasikan fitur sesuai kebutuhan.');
        });
    </script>
</body>
</html>