<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Sparepart Motor</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f3e8ff',
                            100: '#e9d5ff',
                            500: '#7c3aed',
                            600: '#6d28d9',
                            700: '#5b21b6'
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom progress bar styles */
        .diagnosa-progress {
            @apply flex justify-between relative mb-10;
        }
        .diagnosa-progress::before {
            content: '';
            @apply absolute top-1/2 left-0 w-full h-1 bg-gray-200 transform -translate-y-1/2 z-10;
        }
        .progress-bar-line {
            @apply absolute top-1/2 left-0 h-1 bg-gradient-to-r from-primary-500 to-primary-600 transform -translate-y-1/2 z-20 transition-all duration-500;
        }
        .progress-step {
            @apply flex flex-col items-center text-center z-30 w-28;
        }
        .step-circle {
            @apply w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300 border-4 border-gray-50;
        }
        .step-label {
            @apply text-sm font-semibold text-gray-500 mt-2;
        }
        .progress-step.active .step-circle {
            @apply bg-gradient-to-r from-primary-500 to-primary-600 text-white border-primary-50;
        }
        .progress-step.active .step-label {
            @apply text-primary-500;
        }
    </style>
</head>
<body class="bg-gray-50 font-inter min-h-screen">
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
    
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="fixed top-4 left-4 z-50 lg:hidden bg-white p-2 rounded-lg shadow-lg">
        <i class="fas fa-bars text-gray-700"></i>
    </button>
    
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?= $this->include('layout/sidebar') ?>

        <!-- Content Area -->
        <main class="flex-1 lg:ml-64 ml-0 transition-all duration-300">
            <div class="p-4 lg:p-6">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>
    
    <!-- Footer and Scripts -->
    <?= $this->include('layout/footer') ?>
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const sidebar = document.querySelector('.sidebar');
            
            function toggleMobileMenu() {
                sidebar.classList.toggle('translate-x-0');
                sidebar.classList.toggle('-translate-x-full');
                mobileOverlay.classList.toggle('hidden');
            }
            
            mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            mobileOverlay.addEventListener('click', toggleMobileMenu);
        });
    </script>
</body>
</html>
