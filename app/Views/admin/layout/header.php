<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Sistem Pakar</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS for Modern Dashboard -->
    <style>
        :root {
            --primary-color: #7c3aed;
            --primary-gradient: linear-gradient(135deg, #7c3aed, #a855f7);
            --background-color: #f0f2f5;
            --sidebar-bg: #1a202c;
            --text-light: #f7fafc;
            --text-dark: #2d3748;
            --card-bg: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            display: flex;
        }

        .main-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* --- Sidebar Styling --- */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            transition: margin-left 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 25px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #2d3748;
        }
        .sidebar-header h3 { margin: 0; font-size: 1.25rem; font-weight: 700; }
        .sidebar-header .icon { width: 30px; height: 30px; }

        .sidebar-nav { flex-grow: 1; list-style: none; padding: 20px 0; margin: 0; }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 30px;
            color: #a0aec0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            border-left: 4px solid transparent;
        }
        .sidebar-nav a:hover { background-color: #2d3748; color: var(--text-light); }
        .sidebar-nav a.active {
            background-color: rgba(124, 58, 237, 0.1);
            color: var(--text-light);
            border-left: 4px solid var(--primary-color);
            font-weight: 600;
        }
        .sidebar-nav a .icon { width: 22px; height: 22px; }

        .sidebar-footer { padding: 20px 30px; border-top: 1px solid #2d3748; }
        .sidebar-footer a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(255,255,255,0.05);
            color: #a0aec0;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        .sidebar-footer a:hover { background-color: #2d3748; color: var(--text-light); }


        /* --- Content Area --- */
        .content-area {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 30px;
            transition: all 0.3s;
        }
        
        /* --- Top Navbar in Content --- */
        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .top-navbar h1 { margin: 0; font-size: 1.8rem; font-weight: 700; color: var(--text-dark); }
        .user-profile { display: flex; align-items: center; gap: 10px; }
        .user-profile .dropdown-toggle { color: var(--text-dark); text-decoration: none; font-weight: 600;}
        .user-profile .dropdown-toggle::after { display: none; } /* Hide default caret */
        .user-profile i { font-size: 1.5rem; color: #a0aec0; }

        /* General Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow);
            background: var(--card-bg);
        }
        .card-header {
            background: var(--primary-gradient);
            color: white;
            padding: 20px;
            border-bottom: none;
            border-radius: 12px 12px 0 0 !important;
        }
        .card-header h2, .card-header h4, .card-header h6 {
            margin: 0;
            font-weight: 600;
        }
        .card-body { padding: 30px; }

        /* Button Styling */
        .btn-primary {
            background: var(--primary-gradient) !important;
            border: none !important;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
        }
        .btn-ai {
            background: var(--primary-gradient) !important;
            color: white !important;
            font-weight: 600;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
         .btn-ai:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <!-- Sidebar -->
        <?= $this->include('admin/layout/sidebar') ?>

        <!-- Content Area -->
        <main class="content-area">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
    
    <!-- Bootstrap JS and any other scripts go here -->
    <?= $this->include('admin/layout/footer') ?>
</body>
</html>
