<?php
session_start();

// Check if admin ID verification was done
if (!isset($_SESSION['reset_admin_id'])) {
    header('Location: verify-admin-id.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Admin</title>
    <link rel="stylesheet" href="css/password-reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">
            <div class="reset-header">
                <i class="fas fa-key"></i>
                <h2>Reset Admin Password</h2>
                <p>Create a new password for your account</p>
                <p class="admin-id-display">
                    <i class="fas fa-id-card"></i>
                    Admin ID: <?php echo htmlspecialchars($_SESSION['reset_admin_id']); ?>
                </p>
            </div>

            <form action="../../src/Controllers/AdminPasswordResetController.php" method="POST" class="reset-form" id="resetForm">
                <input type="hidden" name="action" value="reset_password">
                
                <div class="form-group">
                    <label for="new_password">
                        <i class="fas fa-lock"></i>
                        New Password
                    </label>
                    <input 
                        type="password" 
                        name="new_password" 
                        id="new_password" 
                        placeholder="Enter new password"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="confirm_password">
                        <i class="fas fa-lock"></i>
                        Confirm Password
                    </label>
                    <input 
                        type="password" 
                        name="confirm_password" 
                        id="confirm_password" 
                        placeholder="Confirm new password"
                        required
                    >
                </div>

                <div class="password-requirements">
                    <p><i class="fas fa-info-circle"></i> Password Requirements:</p>
                    <ul>
                        <li>Make sure both passwords match</li>
                    </ul>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-check-circle"></i>
                    Reset Password
                </button>

                <div class="form-footer">
                    <a href="verify-admin-id.php" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Change Admin ID
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Client-side password validation
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
        });
    </script>
</body>
</html>