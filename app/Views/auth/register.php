<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem CodeIgniter</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General body styling - identical to the login page for consistency */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* The main container holding the two columns */
        .register-container-wrapper {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            width: 100%;
            max-width: 960px;
            overflow: hidden;
        }

        /* Left column (form side) */
        .register-left {
            padding: 50px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Right column (welcome message side) */
        .register-right {
            background: linear-gradient(135deg, rgb(60, 180, 249), rgb(60, 180, 249));
            color: #fff;
            padding: 60px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles for the right panel */
        .register-right::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 1;
        }

        .register-right::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            z-index: 1;
        }
        
        .register-right-content {
            position: relative;
            z-index: 2;
        }

        /* Styling for headings */
        .register-left h2 {
            font-size: 2.5em;
            color: #1a202c;
            margin-bottom: 30px; /* Increased margin for better spacing */
            font-weight: 700;
        }

        .register-right h1 {
            font-size: 3em;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .register-right p {
            font-size: 1.1em;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 15px; /* Slightly reduced margin for a tighter form */
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
            font-size: 0.9em;
        }

        .form-control {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            border-color: rgb(60, 180, 249);
            box-shadow: 0 0 0 3px rgba(60, 180, 249, 0.2);
            outline: none;
        }
        
        /* Re-styling the original .btn-register to match the login button */
        .btn-register {
            background: linear-gradient(90deg, rgb(60, 180, 249), rgb(60, 180, 249));
            color: #fff;
            border: none;
            padding: 15px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            width: 100%;
            margin-top: 10px; /* Added margin on top */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-register:hover {
             background: linear-gradient(90deg, rgb(50, 160, 229), rgb(50, 160, 229));
             transform: translateY(-2px);
             box-shadow: 0 4px 15px rgba(60, 180, 249, 0.4);
        }

        /* Login link at the bottom */
        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9em;
            color: #718096;
        }

        .login-link a {
            color: rgb(60, 180, 249);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: rgb(50, 160, 229);
            text-decoration: underline;
        }
        
        /* Alert styling for PHP messages */
        .alert {
            width: 100%;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
             .register-right {
                display: none;
            }
             .register-left {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            .register-left {
                padding: 30px;
            }
            .register-left h2 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="register-container-wrapper">
        <!-- Left side of the register panel -->
        <div class="register-left">
            <h2>Daftar Akun Baru</h2>
            
            <!-- PHP success/error messages will be displayed here -->
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <p class="mb-0"><?= $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- The registration form, functionally unchanged -->
            <form action="/auth/processRegistration" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" placeholder="Buat username anda">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="you@example.com">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Buat password anda">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password anda">
                </div>
                <button type="submit" class="btn btn-register">Daftar</button>
            </form>
            
            <div class="login-link">
                Sudah punya akun? <a href="/auth/login">Login disini</a>
            </div>
        </div>
        
        <!-- Right side of the register panel -->
        <div class="register-right">
             <div class="register-right-content">
                <h1>Hello!</h1>
                <p>Buat akun baru untuk memulai sistem pakar rekomendasi sparepart kendaraan roda dua.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
