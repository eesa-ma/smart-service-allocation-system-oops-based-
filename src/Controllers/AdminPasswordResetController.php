<?php
session_start();
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Model/Admin.php';

class AdminPasswordResetController {
    private $conn;
    private $admin;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        $this->admin = new Admin($this->conn);
    }

    /**
     * Step 1: Verify admin ID
     */
    public function verifyAdminId() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminId = $_POST['admin_id'];

            // Verify admin ID exists
            $adminData = $this->admin->verifyAdminId($adminId);

            if ($adminData) {
                // Store admin ID in session for password reset
                $_SESSION['reset_admin_id'] = $adminId;
                echo "<script>alert('Admin ID verified! You can now reset your password.'); window.location.href='../../templates/admin/reset-passwoord.php';</script>";
            } else {
                echo "<script>alert('Admin ID not found!'); window.location.href='../../templates/admin/verify-admin-id.php';</script>";
            }
        }
    }

    /**
     * Step 2: Reset password
     */
    public function resetPassword() {
        // Check if admin ID verification was done
        if (!isset($_SESSION['reset_admin_id'])) {
            echo "<script>alert('Please verify your Admin ID first.'); window.location.href='../../templates/admin/verify-admin-id.php';</script>";
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
            $adminId = $_SESSION['reset_admin_id'];
            $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
            if ($this->admin->resetPassword($adminId, $hashed)) {
                // Clear session
                unset($_SESSION['reset_admin_id']);
                echo "<script>alert('Password updated successfully!'); window.location.href='../../templates/admin/admin-signin.php';</script>";
            } else {
                echo "<script>alert('Error updating password.'); window.history.back();</script>";
            }
        }
    }
}

// Router
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminPasswordResetController();
    
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'verify_admin_id') {
            $controller->verifyAdminId();
        } elseif ($_POST['action'] === 'reset_password') {
            $controller->resetPassword();
        }
    }
}
?>