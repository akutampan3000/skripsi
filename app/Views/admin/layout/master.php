<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('admin/layout/header') ?>
</head>
<body class="bg-light">
    <?= $this->include('admin/layout/navbar') ?>
    
    <div class="container-fluid">
        <div class="row">
            <?= $this->include('admin/layout/sidebar') ?>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>