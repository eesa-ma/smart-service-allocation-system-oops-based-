<?php
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include __DIR__ . '/../Core/Database.php';
    include __DIR__ . '/../Model/Admin.php';
    include __DIR__ . '/../Model/Technician.php';
    include __DIR__ . '/../Model/ServiceRequest.php';  // Add this line

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
                if(password_verify($password, $adminData["Password"])) {
                    session_regenerate_id(true);
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

                $technician->name = mysqli_real_escape_string($this->conn, trim($_POST["tech-name"]));
                
                if (isset($_POST["tech-skill"]) && is_array($_POST["tech-skill"])) {
                    $skills = array_map(function($skill) {
                        return mysqli_real_escape_string($this->conn, trim($skill));
                    }, $_POST["tech-skill"]);
                    $technician->skills = implode(", ", $skills);
                } else {
                    $technician->skills = isset($_POST["tech-skill"]) ? mysqli_real_escape_string($this->conn, trim($_POST["tech-skill"])) : "";
                }
                
                $technician->email = mysqli_real_escape_string($this->conn, trim($_POST["tech-mail"]));
                $technician->phoneno = mysqli_real_escape_string($this->conn, trim($_POST["tech-phone"]));
                $house = mysqli_real_escape_string($this->conn, trim($_POST["house"]));
                $street = mysqli_real_escape_string($this->conn, trim($_POST["street"]));
                $city = mysqli_real_escape_string($this->conn, trim($_POST["city"]));
                $pincode = mysqli_real_escape_string($this->conn, trim($_POST["pincode"]));
                $technician->address = "$house, $street, $city - $pincode";
                $technician->password = mysqli_real_escape_string($this->conn, $password);

                $result = $technician->createAccount();
                
                if ($result === true) {
                    echo "<script>alert('Technician account created successfully!'); window.location.href='../../templates/admin/admin-dashboard.php';</script>";
                } elseif ($result === "email_exists") {
                    echo "<script>alert('Error: This email address is already registered. Please use a different email.'); window.history.back();</script>";
                } elseif ($result === "phone_exists") {
                    echo "<script>alert('Error: This phone number is already registered. Please use a different phone number.'); window.history.back();</script>";
                } else {
                    echo "<script>alert('Error: Could not create technician account. Please try again later.'); window.history.back();</script>";
                }
            }
        }

        // NEW METHODS FOR MANAGE SERVICE

        public function assignTechnician() {
            if (!isset($_SESSION['Admin_ID'])) {
                header('Location: ../../templates/admin/admin-signin.php');
                exit();
            }

            $request_id = filter_input(INPUT_POST, 'request_id', FILTER_VALIDATE_INT);
            $technician_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);

            if (!$request_id || !$technician_id) {
                $_SESSION['message'] = 'Invalid request or technician ID.';
                header('Location: ../../templates/admin/manage-service.php');
                exit();
            }

            $serviceRequest = new ServiceRequest($this->conn);
            
            if ($serviceRequest->assignTechnician($request_id, $technician_id)) {
                $_SESSION['message'] = 'Technician assigned successfully.';
            } else {
                $_SESSION['message'] = 'Failed to assign technician.';
            }

            header('Location: ../../templates/admin/manage-service.php');
            exit();
        }

        public function deleteRequest() {
            if (!isset($_SESSION['Admin_ID'])) {
                header('Location: ../../templates/admin/admin-signin.php');
                exit();
            }

            $request_id = filter_input(INPUT_POST, 'request_id', FILTER_VALIDATE_INT);

            if (!$request_id) {
                $_SESSION['message'] = 'Invalid request ID.';
                header('Location: ../../templates/admin/manage-service.php');
                exit();
            }

            $serviceRequest = new ServiceRequest($this->conn);
            
            if ($serviceRequest->deleteRequest($request_id)) {
                $_SESSION['message'] = 'Request deleted successfully.';
            } else {
                $_SESSION['message'] = 'Failed to delete request.';
            }

            header('Location: ../../templates/admin/manage-service.php');
            exit();
        }

        public function getPendingRequests() {
            if (!isset($_SESSION['Admin_ID'])) {
                header('Location: ../../templates/admin/admin-signin.php');
                exit();
            }

            $serviceRequest = new ServiceRequest($this->conn);
            return $serviceRequest->getPendingAndRejectedRequests();
        }

        public function getAvailableTechnicians($location) {
            if (!isset($_SESSION['Admin_ID'])) {
                return [];
            }

            $technician = new Technician($this->conn);
            return $technician->getAvailableTechniciansByLocation($location);
        }
    }

    // UPDATED ACTION HANDLER
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $adminController = new AdminController();
        
        switch ($_POST['action']) {
            case 'signin':
                $adminController->signin();
                break;
            case 'addtechnician':
                $adminController->AddTechnician();
                break;
            case 'assign_technician':
                $adminController->assignTechnician();
                break;
            case 'delete_request':
                $adminController->deleteRequest();
                break;
            default:
                echo "<script>alert('Invalid action'); window.history.back();</script>";
        }
    }
?>