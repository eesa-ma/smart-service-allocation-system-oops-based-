<?php
session_start();
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Model/Technician.php';

class TechnicianPasswordResetController {
    private $conn;
    private $technician;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        $this->technician = new Technician($this->conn);
    }

    /**
     * Step 1: Verify technician email
     */
    public function verifyEmail() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            // Verify email exists
            $technicianData = $this->technician->verifyEmail($email);

            if ($technicianData) {
                // Store email in session for password reset
                $_SESSION['reset_tech_email'] = $email;
                echo "<script>alert('Email verified! You can now reset your password.'); window.location.href='../../templates/technician/reset-password.php';</script>";
            } else {
                echo "<script>alert('Email not found! Please contact admin.'); window.location.href='../../templates/technician/verify-email.php';</script>";
            }
        }
    }

    /**
     * Step 2: Reset password
     */
    public function resetPassword() {
        // Check if email verification was done
        if (!isset($_SESSION['reset_tech_email'])) {
            echo "<script>alert('Please verify your email first.'); window.location.href='../../templates/technician/verify-email.php';</script>";
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

            // Reset password
            $email = $_SESSION['reset_tech_email'];
            if ($this->technician->resetPassword($email, $newPassword)) {
                // Clear session
                unset($_SESSION['reset_tech_email']);
                echo "<script>alert('Password updated successfully!'); window.location.href='../../templates/technician/technician-signin.php';</script>";
            } else {
                echo "<script>alert('Error updating password.'); window.history.back();</script>";
            }
        }
    }
}

// Router
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TechnicianPasswordResetController();
    
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'verify_email') {
            $controller->verifyEmail();
        } elseif ($_POST['action'] === 'reset_password') {
            $controller->resetPassword();
        }
    }
}
?>