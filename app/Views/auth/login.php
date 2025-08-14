<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pakar Rekomendasi Sparepart Motor</title>
    <!-- We can keep Bootstrap for its grid system and utilities, though custom styles will override many aspects -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General body styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5; /* A slightly softer background color */
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* The main container holding the two columns */
        .login-container-wrapper {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            width: 100%;
            max-width: 960px; /* Max width for the container */
            overflow: hidden; /* Ensures the border-radius is respected by child elements */
        }

        /* Left column (form side) */
        .login-left {
            padding: 50px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Right column (welcome message side) */
        .login-right {
            /* The purple gradient background */
            background: linear-gradient(135deg,rgb(60, 180, 249),rgb(60, 180, 249));
            color: #fff;
            padding: 60px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            position: relative; /* Needed for pseudo-elements */
            overflow: hidden; /* Hide overflow from decorative circles */
        }

        /* Decorative circles for the right panel */
        .login-right::before {
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

        .login-right::after {
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

        .login-right-content {
            position: relative;
            z-index: 2; /* Ensure content is above decorative circles */
        }

        /* Styling for headings */
        .login-left h2 {
            font-size: 2.5em;
            color: #1a202c;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .login-left p.subtitle {
            color: #718096;
            margin-bottom: 30px;
        }

        .login-right h1 {
            font-size: 3em;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .login-right p {
            font-size: 1.1em;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
            font-size: 0.9em;
        }

        /* Using the original .form-control class for compatibility */
        .form-control {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            border-color:rgb(60, 180, 249);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.2);
            outline: none;
        }

        /* Remember me and Forgot password section */
        .options-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9em;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: #4a5568;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: #7c3aed;
        }

        .forgot-password a {
            color: #7c3aed;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        /* Using the original .btn-login for compatibility */
        .btn-login {
            background: linear-gradient(90deg,rgb(60, 180, 249),rgb(60, 180, 249));
            color: #fff;
            border: none;
            padding: 15px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            width: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
             background: linear-gradient(90deg,rgb(60, 180, 249),rgb(60, 180, 249));
             transform: translateY(-2px);
             box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
        }

        /* Sign up link at the bottom */
        .signup-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9em;
            color: #718096;
        }

        .signup-link a {
            color: rgb(60, 180, 249);
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            color: rgb(50, 160, 229);
            text-decoration: underline;
        }
        
        /* Alert styling for PHP errors */
        .alert {
            width: 100%;
        }

        /* Password input wrapper styling */
        .password-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-input-wrapper .form-control {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            cursor: pointer;
            color: #718096;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #4a5568;
        }

        .password-toggle:focus {
            outline: none;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
             .login-right {
                display: none; /* Hide the right column on smaller screens */
            }
             .login-left {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            .login-left {
                padding: 30px;
            }
            .login-left h2 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container-wrapper">
        <!-- Left side of the login panel -->
        <div class="login-left">
            <div class="header-section" style="display: flex; align-items: center; margin-bottom: 10px;">
                <h2 style="margin: 0; margin-right: 150px;">Hello!</h2>
                <div class="logo-container">
                    <img src="<?= base_url('logo.png') ?>" alt="Logo" width="150" height="130" style="border-radius: 12px;">
                </div>
            </div>
            <p class="subtitle">Sign in to your account</p>
            
            <!-- PHP error message will be displayed here -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- The login form, functionally unchanged -->
            <form action="/auth/authenticate" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="login_identifier">Username atau Email</label>
                    <input type="text" class="form-control" id="login_identifier" name="login_identifier" placeholder="Masukkan username atau email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input-wrapper">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" fill="none"/>
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                            <svg class="eye-off-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <path d="m1 1 22 22" stroke="currentColor" stroke-width="2"/>
                                <path d="m9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19l-6.72-6.72a3 3 0 0 0-4.24-4.24z" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path d="m1 12s4-8 11-8c1.6 0 3.05.34 4.36.91l-3.17 3.17a3 3 0 0 0-4.24 4.24l-1.48 1.48A18.5 18.5 0 0 1 1 12z" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">Sign In</button>
            </form>

            <div class="signup-link">
                <!-- Updated the signup link text to match the image -->
                Don't have an account? <a href="/auth/register">Create</a>
            </div>
        </div>
        
        <!-- Right side of the login panel -->
        <div class="login-right">
            <div class="login-right-content">
                 <h1>Welcome Back!</h1>
                <p>Selamat datang di sistem pakar rekomendasi sparepart kendaraan roda dua.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Password toggle functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = togglePassword.querySelector('.eye-icon');
            const eyeOffIcon = togglePassword.querySelector('.eye-off-icon');

            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle the eye icons
                if (type === 'password') {
                    eyeIcon.style.display = 'block';
                    eyeOffIcon.style.display = 'none';
                } else {
                    eyeIcon.style.display = 'none';
                    eyeOffIcon.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
