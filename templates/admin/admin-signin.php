<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Smart Service System</title>
    <link rel="stylesheet" href="../admin/css/signin.css?v=2.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="signin-container">
        <div class="signin-card">
            <div class="signin-header">
                <i class="fas fa-user-shield"></i>
                <h2>Admin Sign In</h2>
                <p>Access the administration dashboard</p>
            </div>
            
            <form action="../../src/Controllers/AdminController.php" method="post" id="signinForm">
                <input type="hidden" name="action" value="signin">
                
                <div class="form-group">
                    <label for="admin-id">
                        <i class="fas fa-id-card"></i>
                        Admin ID
                    </label>
                    <input 
                        type="number" 
                        name="admin-id" 
                        id="admin-id" 
                        placeholder="Enter your Admin ID"
                        required
                        autofocus
                    >
                </div>
                
                <div class="form-group">
                    <label for="admin-pass">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="admin-pass" 
                        id="admin-pass" 
                        placeholder="Enter your password"
                        required
                    >
                </div>
                
                <div class="form-footer">
                    <a href="verify-admin-id.php" class="forgot-link">
                        <i class="fas fa-question-circle"></i>
                        Forgot your password?
                    </a>
                </div>
                
                <button type="submit" class="btn-submit" name="submit">
                    <span class="btn-text">Sign In</span>
                    <span class="btn-loading">
                        <i class="fas fa-spinner fa-spin"></i>
                        Signing in...
                    </span>
                </button>
                
                <button type="button" class="btn-back" onclick="window.location.href='../../public/index.php'">
                    <i class="fas fa-arrow-left"></i>
                    Back to Home
                </button>
            </form>
        </div>
    </div>

    <script>
        // Loading state on form submit
        const form = document.getElementById('signinForm');
        const submitBtn = form.querySelector('.btn-submit');
        
        form.addEventListener('submit', function() {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>
