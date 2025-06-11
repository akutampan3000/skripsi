<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Sparepart Motor</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS for Modern User View -->
    <style>
        :root {
            --primary-color: #7c3aed;
            --primary-light: #a855f7;
            --primary-gradient: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            --background-color: #f0f2f5;
            --sidebar-bg: #ffffff; /* Sidebar terang untuk user */
            --text-dark: #2d3748;
            --text-muted: #718096;
            --card-bg: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
        }

        .main-wrapper {
            display: flex;
            width: 100%;
        }

        /* --- Sidebar Styling (User) --- */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid var(--border-color);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .sidebar-header {
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar-header .brand-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
        }
        .sidebar-header h3 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-top: 10px;}

        .sidebar-nav { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            margin-bottom: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease-in-out;
        }
        .sidebar-nav a:hover {
            background-color: #f3e8ff; /* Light purple */
            color: var(--primary-color);
        }
        .sidebar-nav a.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.3);
        }
        .sidebar-nav a .icon { font-size: 1.2rem; }

        /* --- Content Area --- */
        .content-area {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 20px;
        }

        /* --- Top Navbar --- */
        .top-navbar {
            background: var(--card-bg);
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
        }
        .top-navbar .page-title { margin: 0; font-size: 1.5rem; font-weight: 700; color: var(--text-dark); }
        .user-profile .dropdown-toggle { color: var(--text-dark); text-decoration: none; font-weight: 600; }
        .user-profile img { width: 40px; height: 40px; border-radius: 50%; }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }
        .card-body { padding: 30px; }

        /* --- Diagnosa Progress Bar --- */
        .diagnosa-progress {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 40px;
        }
        .diagnosa-progress::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: var(--border-color);
            transform: translateY(-50%);
            z-index: 1;
        }
        .progress-bar-line {
            position: absolute;
            top: 50%;
            left: 0;
            height: 4px;
            background: var(--primary-gradient);
            transform: translateY(-50%);
            z-index: 2;
            transition: width 0.4s ease;
        }
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            z-index: 3;
            width: 120px;
        }
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--border-color);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            transition: all 0.4s ease;
            border: 4px solid var(--background-color);
        }
        .step-label { font-size: 0.9rem; font-weight: 600; color: var(--text-muted); margin-top: 10px; }

        .progress-step.active .step-circle {
            background: var(--primary-gradient);
            color: white;
            border-color: #f3e8ff;
        }
         .progress-step.active .step-label { color: var(--primary-color); }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <!-- Sidebar -->
        <?= $this->include('layout/sidebar') ?>

        <!-- Content Area -->
        <main class="content-area">
             <!-- This header will now be part of each page's content section -->
            <?= $this->renderSection('content') ?>
        </main>
    </div>
    
    <!-- Footer and Scripts -->
    <?= $this->include('layout/footer') ?>
</body>
</html>
