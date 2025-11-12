<?php
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Ensure session is started for accessing $_SESSION['id'] during requests
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once __DIR__ . '/../Core/Database.php';
    include_once __DIR__ . '/../Model/User.php';
    include_once __DIR__ . '/../Model/ServiceRequest.php';

    class UserController {

    private $conn;

    public function __construct() {
        $database = new Database(); //new db object
        $this->conn = $database->connect(); //connection
        
        // Check if connection was successful
        if (!$this->conn) {
            die("Database connection failed. Please check your database configuration.");
        }
    }

    public function register() {
        // Validate required POST data exists
        if (!isset($_POST["user-name"]) || !isset($_POST["user-email"]) || 
            !isset($_POST["user-password"]) || !isset($_POST["confirm-password"])) {
            echo "<script>alert('All fields are required.'); window.history.back();</script>";
            exit();
        }

        $password = $_POST["user-password"];
        $confirmPassword = $_POST["confirm-password"];

        if ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
            exit();
        }

        // Create a new User model and pass the connection
        $user = new User($this->conn);

        // Sanitize and assign data from the form to the user object's properties
        $user->name = mysqli_real_escape_string($this->conn, trim($_POST["user-name"]));
        $user->email = mysqli_real_escape_string($this->conn, trim($_POST["user-email"]));
        $user->phoneNo = mysqli_real_escape_string($this->conn, trim($_POST["user-phone"]));
        $user->password = mysqli_real_escape_string($this->conn, $password);
        $house = mysqli_real_escape_string($this->conn, trim($_POST["house"]));
        $street = mysqli_real_escape_string($this->conn, trim($_POST["street"]));
        $city = mysqli_real_escape_string($this->conn, trim($_POST["city"]));
        $pincode = mysqli_real_escape_string($this->conn, trim($_POST["pincode"]));
        $user->address = "$house, $street, $city - $pincode";

        // Call the register method on the user object
        $result = $user->register();
        
        if ($result === true) {
            echo "<script>alert('Account created successfully!'); window.location.href='../../templates/user/user-signin.php';</script>";
        } elseif ($result === "email_exists") {
            echo "<script>alert('Error: This email address is already registered. Please use a different email or try logging in.'); window.history.back();</script>";
        } elseif ($result === "phone_exists") {
            echo "<script>alert('Error: This phone number is already registered. Please use a different phone number.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Error: Could not create account. Please try again later.'); window.history.back();</script>";
        }
    }

    public function requestService() {
      if (!isset($_SESSION["id"])) {
        echo "<script>alert('User not logged in. Please log in first.'); window.location.href='../../templates/user/user-signin.php';</script>";
        exit();  
        }  

        $serviceRequest = new serviceRequest($this->conn);

        $serviceRequest->servicetype = $_POST["serviceType"];
        $serviceRequest->description = $_POST["description"];
        $serviceRequest->location = $_POST["location"]; 
        $serviceRequest->mobileno = $_POST["mobile"];

        if(isset($_SESSION["id"])) {
            $serviceRequest->userID = $_SESSION["id"];
        }

        if($serviceRequest->addrequest()) {
            echo "<script>
                    alert('Your service request has been submitted successfully!');
                    window.location.href = '../../templates/user/user-dashboard.php';
                  </script>";
        } else {
            echo "Error: " . mysqli_error($this->conn);
        }
    } 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'register') {
            $userController->register();
        } elseif ($_POST['action'] == 'request_service') {
            $userController->requestService();
        }
    }
}

?>
