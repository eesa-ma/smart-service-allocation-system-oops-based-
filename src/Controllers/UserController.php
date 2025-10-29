<?php
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
    }

    public function register() {
        if (isset($_POST["submit"])) {
            $password = $_POST["user-password"];
            $confirmPassword = $_POST["confirm-password"];

            if ($password !== $confirmPassword) {
                echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
                exit();
            }

            // Create a new User model and pass the connection
            $user = new User($this->conn);

            // Assign data from the form to the user object's properties
            $user->name = $_POST["user-name"];
            $user->email = $_POST["user-email"];
            $user->phoneNo = $_POST["user-phone"];
            $user->password = $password;
            $house = $_POST["house"];
            $street = $_POST["street"];
            $city = $_POST["city"];
            $pincode = $_POST["pincode"];
            $user->address = "$house, $street, $city - $pincode";

            // Call the register method on the user object
            if ($user->register()) {
                echo "<script>alert('Account created successfully!'); window.location.href='../../templates/user/user-signin.php';</script>";
            } else {
                echo "<script>alert('Error: Could not create account.'); window.history.back();</script>";
            }
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
