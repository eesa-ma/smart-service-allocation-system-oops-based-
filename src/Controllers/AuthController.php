<?php
session_start();
include '../Core/Database.php';
include '../Model/User.php';
// require_once __DIR__ . '/../Models/Admin.php';
// require_once __DIR__ . '/../Models/Technician.php';

class AuthController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function signin()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        $model = null;
        $redirectPage = '';
        // $userData = null;
        $idColumn = ''; // Variable for the ID column name
        $nameColumn = 'Name'; // Assuming 'Name' is consistent

        // 1. Select the correct Model based on the role
        switch ($role) {
            // case 'admin':
            //     $model = new Admin($this->conn);
            //     $redirectPage = '/templates/admin/dashboard.php';
            //     break;
            // case 'technician':
            //     $model = new Technician($this->conn);
            //     $redirectPage = '/templates/technician/dashboard.php';
            //     break;
            case 'user':
            default:
                $model = new User($this->conn);
                $idColumn = 'user_ID';
                $redirectPage = '../../templates/user/user-dashboard.php';
                break;
        }

        // 2. Use the selected Model to find the user
        $userData = $model->findByEmail($email);

        // 3. Verify password and redirect
        if ($userData) {
            if ($password == $userData["Password"]) {
                $_SESSION["role"] = $role;
                $_SESSION["id"] = $userData[$idColumn]; // Ensure your ID column is named consistently
                $_SESSION["name"] = $userData[$nameColumn];

                header("Location: " . $redirectPage);
                exit();
            } else {
                echo "<script>alert('Incorrect password!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('User not found!'); window.history.back();</script>";
        }
    }
}

// --- Router Logic ---
if (isset($_POST['action']) && $_POST['action'] == 'signin') {
    $authController = new AuthController();
    $authController->signin();
}
?>