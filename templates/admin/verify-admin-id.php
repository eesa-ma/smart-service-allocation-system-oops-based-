<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Admin ID - Password Reset</title>
    <link rel="stylesheet" href="css/password-reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">
            <div class="reset-header">
                <i class="fas fa-shield-alt"></i>
                <h2>Admin Password Reset</h2>
                <p>Enter your Admin ID to reset password</p>
            </div>

            <form action="../../src/Controllers/AdminPasswordResetController.php" method="POST" class="reset-form">
                <input type="hidden" name="action" value="verify_admin_id">
                
                <div class="form-group">
                    <label for="admin_id">
                        <i class="fas fa-id-card"></i>
                        Admin ID
                    </label>
                    <input 
                        type="number" 
                        name="admin_id" 
                        id="admin_id" 
                        placeholder="Enter your Admin ID (e.g., 1001)"
                        required
                        autofocus
                    >
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-check-circle"></i>
                    Verify Admin ID
                </button>

                <div class="form-footer">
                    <a href="admin-signin.php" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>