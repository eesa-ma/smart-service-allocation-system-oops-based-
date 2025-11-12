<?php
session_start();
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Model/User.php';

class PasswordResetController {
    private $conn;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        $this->user = new User($this->conn);
    }

    public function verifyEmail() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            // Verify email exists
            $userData = $this->user->verifyEmail($email);

            if ($userData) {
                // Store email in session for password reset
                $_SESSION['reset_email'] = $email;
                echo "<script>alert('Email verified! You can now reset your password.'); window.location.href='../../templates/user/reset-password.php';</script>";
            } else {
                echo "<script>alert('Email not found! Please sign up first.'); window.location.href='../../templates/user/verify-email.php';</script>";
            }
        }
    }

    /**
 * Step 2: Reset password
 */
public function resetPassword() {
    // Check if email verification was done
        if (!isset($_SESSION['reset_email'])) {
            echo "<script>alert('Please verify your email first.'); window.location.href='../../templates/user/verify-email.php';</script>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validate passwords
            if (empty($newPassword) || empty($confirmPassword)) {
                echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
                exit;
            }

            if ($newPassword !== $confirmPassword) {
                echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
                exit;
            }

            // Reset password with hashing
            $email = $_SESSION['reset_email'];
            $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
            if ($this->user->resetPassword($email, $hashed)) {
                // Clear session
                unset($_SESSION['reset_email']);
                echo "<script>alert('Password updated successfully!'); window.location.href='../../templates/user/user-signin.php';</script>";
            } else {
                echo "<script>alert('Error updating password.'); window.history.back();</script>";
            }
        }
    }
}

// Router
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PasswordResetController();
    
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'verify_email') {
            $controller->verifyEmail();
        } elseif ($_POST['action'] === 'reset_password') {
            $controller->resetPassword();
        }
    }
}
?>