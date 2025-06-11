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
            background: linear-gradient(135deg, #7c3aed, #a855f7);
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
            border-color: #a855f7;
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
            background: linear-gradient(90deg, #7c3aed, #a855f7);
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
             background: linear-gradient(90deg, #6d28d9, #9333ea);
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
            color: #7c3aed;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
        
        /* Alert styling for PHP errors */
        .alert {
            width: 100%;
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
            <h2>Hello!</h2>
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
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
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
</body>
</html>
