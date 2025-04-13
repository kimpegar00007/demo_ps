<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: views/admin/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #0b1727;
            --primary-medium: #112240;
            --primary-light: #1e3a8a;
            --accent-blue: #3b82f6;
            --accent-teal: #14b8a6;
            --accent-purple: #8b5cf6;
            --text-light: #f8fafc;
            --text-medium: #94a3b8;
            --card-bg: rgba(15, 23, 42, 0.8);
            --glow-color: rgba(59, 130, 246, 0.5);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: var(--primary-dark);
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(20, 184, 166, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.05) 0%, transparent 80%);
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            position: relative;
            overflow: hidden;
        }
        
        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 15px;
            position: relative;
            z-index: 2;
        }
        
        .card {
            border: none;
            border-radius: 16px;
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2),
                        0 1px 3px rgba(0, 0, 0, 0.1),
                        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: var(--text-light);
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3),
                        0 1px 3px rgba(0, 0, 0, 0.1),
                        inset 0 0 0 1px rgba(255, 255, 255, 0.12),
                        0 0 20px var(--glow-color);
        }
        
        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            padding: 30px 20px 15px;
            position: relative;
        }
        
        .system-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .system-logo::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid var(--accent-blue);
            border-top-color: var(--accent-teal);
            border-bottom-color: var(--accent-purple);
            animation: spin 5s linear infinite;
        }
        
        .system-logo::after {
            content: '';
            position: absolute;
            inset: 8px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-left-color: var(--accent-teal);
            border-right-color: var(--accent-purple);
            animation: spin 3s linear infinite reverse;
        }
        
        .system-logo i {
            font-size: 2rem;
            color: var(--text-light);
            z-index: 1;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .system-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 5px;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-teal), var(--accent-purple));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 100%;
            animation: gradient-shift 15s linear infinite;
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .card-body {
            padding: 24px;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-medium);
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-light);
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: none !important;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }
        
        .form-control:focus {
            border-color: var(--accent-blue);
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1) !important;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        
        .input-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent-blue);
            cursor: pointer;
            z-index: 4;
            transition: all 0.3s ease;
        }
        
        .input-icon:hover {
            color: var(--accent-teal);
            transform: translateY(-50%) scale(1.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-teal));
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.2);
            z-index: 1;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
            z-index: -1;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.3);
            background: linear-gradient(135deg, var(--accent-teal), var(--accent-blue));
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid #ef4444;
            color: #fca5a5;
            padding: 16px;
            margin-bottom: 25px;
        }
        
        /* Tech decoration elements */
        .tech-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.6;
            filter: blur(60px);
            z-index: 0;
        }
        
        .tech-circle-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            animation: float 15s ease-in-out infinite;
        }
        
        .tech-circle-2 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.2) 0%, transparent 70%);
            bottom: -80px;
            left: -80px;
            animation: float 18s ease-in-out infinite reverse;
        }
        
        .tech-circle-3 {
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            top: 50%;
            right: -50px;
            animation: float 20s ease-in-out infinite 1s;
        }
        
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(10px, 10px) rotate(5deg); }
            50% { transform: translate(0, 20px) rotate(0deg); }
            75% { transform: translate(-10px, 10px) rotate(-5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }
        
        /* Tech grid background */
        .tech-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(to right, rgba(59, 130, 246, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: -1;
        }
        
        /* Floating particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent-blue);
            margin-right: 10px;
        }
        
        .remember-me label {
            color: var(--text-medium);
            font-size: 0.9rem;
            cursor: pointer;
        }
        
        .toggle-password {
            cursor: pointer;
        }
        
        .footer-text {
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-medium);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="tech-grid"></div>
    <div class="particles" id="particles"></div>
    
    <div class="tech-circle tech-circle-1"></div>
    <div class="tech-circle tech-circle-2"></div>
    <div class="tech-circle tech-circle-3"></div>
    
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-container">
            <div class="card">
                <div class="card-header">
                    <div class="system-logo">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="system-title">Payroll System</h4>
                    <p class="text-medium mt-2">Sign in to access your dashboard</p>
                </div>
                <div class="card-body">
                    <form action="auth/login.php" method="POST">
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
                                <span class="input-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                                <span class="input-icon toggle-password" id="togglePasswordBtn">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                        </div>
                        <div class="remember-me mb-3">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <label for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </form>
                    <p class="footer-text mt-4">© 2025 Payroll System • Secure Login</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePasswordBtn').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            
            if (passwordField.getAttribute('type') === 'password') {
                passwordField.setAttribute('type', 'text');
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.setAttribute('type', 'password');
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
        
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random position
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                particle.style.left = `${posX}%`;
                particle.style.top = `${posY}%`;
                
                // Random size
                const size = Math.random() * 2 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random opacity
                particle.style.opacity = Math.random() * 0.5 + 0.3;
                
                // Animation
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 5;
                particle.style.animation = `float ${duration}s ease-in-out infinite ${delay}s`;
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // Initialize particles on page load
        window.addEventListener('load', createParticles);
    </script>
</body>
</html>
