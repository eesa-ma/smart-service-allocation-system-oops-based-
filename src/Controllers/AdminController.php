<?php
    session_start();

    include '../Core/Database.php';
    include '../Model/Admin.php';
    include '../Model/Technician.php';

    class AdminController {
        private $conn;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->connect();
        }

        public function signin() {
            $admin_ID = $_POST["admin-id"];
            $password = $_POST["admin-pass"];
            $model = new Admin($this->conn);
            $redirectPage = '../../templates/admin/admin-dashboard.php';

            $adminData = $model->findbyAdminID($admin_ID);

            if($adminData) {
                if($password == $adminData["Password"]) {
                    $_SESSION["Admin_ID"] = $adminData["Admin_ID"]; 

                    header("Location: " . $redirectPage);
                    exit();     
                } else {
                    echo "<script>alert('Invalid login credentials'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Invalid login credentials');window.location.href='../../templates/admin/admin-signin.php';</script>";
            }
        }

        public function AddTechnician() {
            if (isset($_POST["submit"])) {
                $password = $_POST["technician-password"];
                $confirmPassword = $_POST["confirm-password"];

                if ($password !== $confirmPassword) {
                echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
                exit();
                }

                $technician = new Technician($this->conn);

                $technician->name = $_POST["tech-name"];      
                $technician->email = $_POST["tech-mail"];
                $technician->phoneno = $_POST["tech-phone"];
                $house = $_POST["house"];
                $street = $_POST["street"];
                $city = $_POST["city"];
                $pincode = $_POST["pincode"];
                $technician->address = "$house, $street, $city - $pincode";
                $technician->password = $password;
            }

            if ($technician->createAccount()) {
                echo "<script>alert('Account created successfully!'); window.location.href='../../templates/admin/admin-dashboard.php';</script>";
            } else {
                echo "<script>alert('Error: Could not create account.'); window.history.back();</script>";
            }
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'signin') {
        $adminController = new AdminController();
        $adminController->signin();
    }

    if (isset($_POST['action']) && $_POST['action'] == 'addtechnician') {
    $adminController = new AdminController();
    $adminController->AddTechnician();
}
?>