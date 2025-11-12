<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Smart Service System</title>
    <link rel="stylesheet" href="css/signin.css?v=4.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="signin-container">
        <div class="signin-card">
            <div class="signin-header">
                <i class="fas fa-user"></i>
                <h2>User Sign In</h2>
                <p>Access your service dashboard</p>
            </div>
            
            <form action="../../src/Controllers/AuthController.php" method="post" id="signinForm">
                <input type="hidden" name="role" value="user">
                <input type="hidden" name="action" value="signin">
                
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Enter your email"
                        required
                        autofocus
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Enter your password"
                        required
                    >
                </div>
                
                <div class="form-footer">
                    <a href="verify-email.php" class="forgot-link">
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
                
                <div class="signup-link">
                    <p>Don't have an account? <a href="../user/create-account.php">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>