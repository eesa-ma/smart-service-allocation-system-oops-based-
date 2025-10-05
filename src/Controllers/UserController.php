<?php
    include '../Core/Database.php';
    include '../Model/User.php';

    $database = new Database(); //database object

    $conn = $database->connect(); //calling connection method

    $user = new User($conn); //Pass the connection to User model


    if (isset($_POST["submit"])) {
        $password = $_POST["user-password"];
        $confirmPassword = $_POST["confirm-password"];

        // First, check if passwords match
        if ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
            exit();
        }

        // Create a new User object with the database connection
        $user = new User($conn);

        // Assign data from the form to the user object's properties
        $user->name = $_POST["user-name"];
        $user->email = $_POST["user-email"];
        $user->phoneNo = $_POST["user-phone"];
        $user->password = $password; // We send the plain password, the class will hash it

        // Combine address fields
        $house = $_POST["house"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $pincode = $_POST["pincode"];
        $user->address = $house . ", " . $street . ", " . $city . " - " . $pincode;

        // Call the register method
        if ($user->register()) {
            echo "<script>alert('Account created successfully!'); </script>"; //window.location.href='user-signin.php';
        } else {
            echo "<script>alert('Error: Could not create account.'); window.history.back();</script>";
        }
    }
?>
