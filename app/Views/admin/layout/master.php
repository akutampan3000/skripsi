<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('admin/layout/header') ?>
</head>
<body class="bg-gray-50 font-sans flex flex-col min-h-screen">
    <?= $this->include('admin/layout/navbar') ?>
    
    <div class="flex flex-1 pt-16">
        <div class="w-64 fixed left-0 top-16 h-full overflow-y-auto lg:block hidden">
            <?= $this->include('admin/layout/sidebar') ?>
        </div>
        
        <main class="flex-1 lg:ml-64 ml-0 p-4 lg:p-6 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>