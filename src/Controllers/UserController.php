<?php
    include '../Core/Database.php';
    include '../Model/User.php';

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
}

//calls register method when form gets submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $controller->register();
}

?>
