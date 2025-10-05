<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Login PLN UID Sulselrabar - Sistem Manajemen Magang">
    <meta name="author" content="PLN UID Sulselrabar">
    <title>PLN Admin Login - Sistem Manajemen Magang</title>

    <!-- Bootstrap CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <!-- Modern Admin CSS -->
    <link href="asset/css/admin-modern.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../../img/favicon.png">

    <style>
      /* Global box-sizing to avoid overflow on narrow screens */
      html { box-sizing: border-box; }
      *, *::before, *::after { box-sizing: inherit; }
      body {
        background: #f5f7fa;
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        overflow-x: hidden;
      }

      .login-container {
        width: 100%;
        max-width: 1200px;
        min-height: 100vh;
        display: flex;
        background: white;
        margin: 0 auto;
        position: relative;
        animation: slideUp 0.8s ease-out;
      }

      .login-card {
        display: flex;
        width: 100%;
        height: 100%;
      }

      @keyframes slideUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* Left Side - Visual Panel */
      .visual-panel {
        flex: 1;
        background: linear-gradient(135deg, var(--pln-primary) 0%, var(--pln-secondary) 100%);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        min-height: 100vh;
      }

      .visual-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="8" height="8" patternUnits="userSpaceOnUse"><path d="M 8 0 L 0 0 0 8" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        z-index: 1;
      }

      .visual-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        max-width: 400px;
        padding: 3rem;
      }

      .pln-logo-large {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
      }

      .pln-logo-large img {
        width: 80px;
        height: 80px;
        object-fit: contain;
      }

      .visual-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
      }

      .visual-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        line-height: 1.6;
        margin-bottom: 2rem;
      }

      .feature-list {
        text-align: left;
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .feature-list li {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        opacity: 0.9;
      }

      .feature-list li i {
        width: 20px;
        margin-right: 12px;
        color: var(--pln-yellow);
      }

      /* Right Side - Login Form */
      .login-panel {
        flex: 1;
        padding: 4rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: white;
        position: relative;
        overflow-y: auto;
        min-height: 100vh;
      }

      .login-header {
        margin-bottom: 3rem;
      }

      .login-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--pln-primary);
        margin-bottom: 0.5rem;
      }

      .login-subtitle {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 2rem;
      }

      .login-body {
        flex: 1;
      }

      .form-group {
        margin-bottom: 1.5rem;
        position: relative;
      }

      .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #374151;
        font-size: 0.9rem;
      }

      .form-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9fafb;
        color: #374151;
      }

      .form-input:focus {
        outline: none;
        border-color: var(--pln-secondary);
        background: white;
        box-shadow: 0 0 0 3px rgba(1, 154, 165, 0.1);
        transform: translateY(-1px);
      }

      .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.1rem;
        margin-top: 12px;
      }

      .form-input:focus + .input-icon {
        color: var(--pln-secondary);
      }

      .login-btn {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, var(--pln-primary) 0%, var(--pln-secondary) 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin-bottom: 1rem;
      }

      .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 98, 122, 0.3);
      }

      .login-btn:active {
        transform: translateY(0);
      }

      .login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
      }

      .login-btn:hover::before {
        left: 100%;
      }

      .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
      }

      .remember-me {
        display: flex;
        align-items: center;
      }

      .remember-me input[type="checkbox"] {
        margin-right: 0.5rem;
        transform: scale(1.1);
        accent-color: var(--pln-secondary);
      }

      .remember-me label {
        font-size: 0.9rem;
        color: #64748b;
      }

      .forgot-password a {
        color: var(--pln-secondary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: color 0.3s ease;
      }

      .forgot-password a:hover {
        color: var(--pln-primary);
        text-decoration: underline;
      }

      .login-footer {
        text-align: center;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
        margin-top: 2rem;
      }

      .login-footer p {
        color: #9ca3af;
        font-size: 0.85rem;
        margin: 0;
      }

      .security-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 212, 0, 0.1);
        color: var(--pln-primary);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 212, 0, 0.2);
        font-weight: 500;
      }

      .security-badge i {
        margin-right: 0.5rem;
        color: var(--pln-yellow);
      }

      .divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
      }

      .divider::before,
      .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
      }

      .divider span {
        padding: 0 1rem;
        color: #9ca3af;
        font-size: 0.85rem;
      }

      /* Mobile Responsive */
      @media (max-width: 1024px) {
        .login-container { max-width: 100%; }
        /* Stack visual + form vertically on tablet/mobile */
        .login-card { flex-direction: column; }
        .visual-panel, .login-panel { width: 100%; }
        .login-container { min-height: 100vh; }
        
        .visual-panel { flex: none; min-height: 40vh; }
        
        .login-panel { flex: 1; min-height: 60vh; padding: 2rem; }
      }

      @media (max-width: 768px) {
        .visual-panel {
          min-height: 35vh;
        }
        
        .visual-content {
          padding: 2rem;
        }
        
        .pln-logo-large {
          width: 80px;
          height: 80px;
          margin-bottom: 1rem;
        }
        
        .pln-logo-large img {
          width: 50px;
          height: 50px;
        }
        
        .visual-title {
          font-size: 1.8rem;
        }
        
        .visual-subtitle {
          font-size: 0.95rem;
          margin-bottom: 1rem;
        }
        
        .feature-list {
          display: none;
        }
        
        .login-panel {
          padding: 2rem;
          min-height: 65vh;
        }
        
        .login-title {
          font-size: 1.8rem;
        }
      }

      @media (max-width: 576px) {
        .visual-panel {
          min-height: 30vh;
        }
        
        .login-panel {
          padding: 1.5rem;
          min-height: 70vh;
        }
        
        .visual-content {
          padding: 1.5rem;
        }
        
        .visual-title {
          font-size: 1.5rem;
        }
        
        .visual-subtitle {
          font-size: 0.9rem;
        }
      }

      @media (max-width: 480px) {
        .login-panel {
          padding: 1rem;
        }
        
        .visual-content {
          padding: 1rem;
        }
        
        .form-input {
          padding: 0.8rem 0.8rem 0.8rem 2.5rem;
          font-size: 0.9rem;
        }
        
        .input-icon {
          left: 0.8rem;
        }
        
        /* Ensure space for password toggle icon */
        .form-input { padding-right: 2.75rem; }

        .login-btn {
          padding: 0.9rem;
          font-size: 1rem;
        }
      }

      @media (max-height: 600px) {
        .visual-panel {
          min-height: 50vh;
        }
        
        .login-panel {
          min-height: 50vh;
          justify-content: flex-start;
          padding-top: 2rem;
        }
        
        .login-header {
          margin-bottom: 1.5rem;
        }
      }

      /* Loading animation */
      .btn-loading {
        pointer-events: none;
        opacity: 0.7;
      }

      .btn-loading::after {
        content: '';
        width: 20px;
        height: 20px;
        margin-left: 10px;
        border: 2px solid transparent;
        border-top: 2px solid #ffffff;
        border-radius: 50%;
        display: inline-block;
        animation: spin 1s linear infinite;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      /* --- Mobile Optimization (No design changes) --- */
      /* Use dynamic viewport units where supported to avoid 100vh issues on mobile */
      @supports (height: 100dvh) {
        .login-container, .visual-panel, .login-panel { min-height: 100dvh; }
      }

      /* Avoid inner scroll on mobile; let the page scroll instead */
      @media (max-width: 1024px) {
        .login-panel { overflow-y: visible; }
      }

      /* Respect safe-area for notched devices */
      :root { --safe-top: env(safe-area-inset-top); --safe-bottom: env(safe-area-inset-bottom); }
      @media (max-width: 768px) {
        body { padding-bottom: var(--safe-bottom); }
        .login-panel { padding-bottom: calc(1.5rem + var(--safe-bottom)); }
        .visual-panel { padding-top: calc(1rem + var(--safe-top)); }
      }

      /* Reduce motion for users who prefer it without altering visuals */
      @media (prefers-reduced-motion: reduce) {
        * { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; }
      }

      /* Improve tap responsiveness and prevent accidental highlights */
      html { -webkit-tap-highlight-color: transparent; }
      /* Ensure logo image scales nicely inside its container on very small devices */
      .pln-logo-large img { max-width: 100%; height: auto; }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="login-card">
        <!-- Left Side - Visual Panel -->
        <div class="visual-panel">
          <div class="visual-content">
            <div class="pln-logo-large">
              <img src="asset/LOGO PLN.png" alt="PLN Logo">
            </div>
            <h1 class="visual-title">Welcome Back!</h1>
            <p class="visual-subtitle">Sistem Manajemen Magang PLN UID Sulselrabar dengan teknologi terdepan untuk pengalaman yang lebih baik.</p>
            
            <ul class="feature-list">
              <li><i class="fas fa-check-circle"></i> Dashboard Analytics Real-time</li>
              <li><i class="fas fa-check-circle"></i> Sistem Keamanan Berlapis</li>
              <li><i class="fas fa-check-circle"></i> Mobile Responsive Design</li>
              <li><i class="fas fa-check-circle"></i> Auto Backup & Recovery</li>
            </ul>
          </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-panel">
          <div class="login-header">
            <h1 class="login-title">Sign In</h1>
            <p class="login-subtitle">Please log in to your account to continue</p>
          </div>

          <div class="login-body">
            <div class="security-badge">
              <i class="fas fa-shield-alt"></i>
              Secure Login System
            </div>

            <form method="post" action="cek_login.php" id="loginForm">
              <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-input" placeholder="Enter your username" required autofocus>
                <i class="fas fa-user input-icon"></i>
              </div>

              <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
                <i class="fas fa-lock input-icon"></i>
              </div>

              <div class="form-options">
                <div class="remember-me">
                  <input type="checkbox" id="remember" name="remember" value="1">
                  <label for="remember">Remember me</label>
                </div>
                <div class="forgot-password">
                  <a href="reset_password.php">Forgot password?</a>
                </div>
              </div>

              <button type="submit" class="login-btn" id="loginBtn">
                <i class="fas fa-sign-in-alt"></i> Sign In to Dashboard
              </button>
            </form>

            <div class="divider">
              <span>PLN UID Sulselrabar</span>
            </div>
          </div>

          <!-- Footer -->
          <div class="login-footer">
            <p><i class="fas fa-copyright"></i> 2025 PLN UID Sulselrabar | Developed by <strong>FFA Team - UNM</strong></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="asset/js/jquery-3.5.1.slim.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    
    <script>
      // Form submission with loading state
      document.getElementById('loginForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('loginBtn');
        btn.classList.add('btn-loading');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
      });

      // Add floating label effect
      document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
          if (this.value === '') {
            this.parentElement.classList.remove('focused');
          }
        });
      });

      // Password visibility toggle (optional enhancement)
      const passwordInput = document.getElementById('password');
      const togglePassword = document.createElement('i');
      togglePassword.classList.add('fas', 'fa-eye', 'password-toggle');
      togglePassword.style.cssText = 'position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #7f8c8d;';
      
      passwordInput.parentElement.appendChild(togglePassword);
      passwordInput.parentElement.style.position = 'relative';
      
      togglePassword.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          this.classList.remove('fa-eye');
          this.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          this.classList.remove('fa-eye-slash');
          this.classList.add('fa-eye');
        }
      });
    </script>
  </body>
</html>
