<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Reset Password</title>
    <link rel="stylesheet" href="css/password-reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">
            <div class="reset-header">
                <i class="fas fa-lock"></i>
                <h2>Forgot Password?</h2>
                <p>Enter your email to reset your password</p>
            </div>

            <form action="../../src/Controllers/PasswordResetController.php" method="POST" class="reset-form">
                <input type="hidden" name="action" value="verify_email">
                
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Enter your registered email"
                        required
                        autofocus
                    >
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-check-circle"></i>
                    Verify Email
                </button>

                <div class="form-footer">
                    <a href="user-signin.php" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>