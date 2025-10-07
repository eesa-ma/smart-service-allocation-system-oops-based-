<?php
    session_start();

    include '../Core/Database.php';
    include '../Model/Admin.php';

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
    }

    if (isset($_POST['action']) && $_POST['action'] == 'signin') {
        $adminController = new AdminController();
        $adminController->signin();
    }
?>