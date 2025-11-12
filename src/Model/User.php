<?php
class User
{
    private $conn;
    public $name;
    public $email;
    public $phoneNo;
    public $address;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register()
    {
        // Check if email already exists
        $existingUser = $this->findByEmail($this->email);
        if ($existingUser) {
            return "email_exists"; // Email already exists
        }
        
        // Check if phone number already exists
        $phoneCheck = "SELECT * FROM `user` WHERE Phone_No = '$this->phoneNo'";
        $result = mysqli_query($this->conn, $phoneCheck);
        if ($result && mysqli_num_rows($result) > 0) {
            return "phone_exists"; // Phone already exists
        }
        
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user` (Name, Email, Phone_No, Address, Password) 
            VALUES ('$this->name', '$this->email', '$this->phoneNo', '$this->address', '$hashedPassword')";

        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            // Log the error for debugging
            error_log("User registration error: " . mysqli_error($this->conn));
            return false;
        }
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM `user` WHERE Email = '$email'";
        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    public function verifyEmail($email) {
        $query = "SELECT User_ID, Name, Email FROM user WHERE Email = '$email'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        
        return false;
    }

    public function resetPassword($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE user SET Password = '$hashedPassword' WHERE Email = '$email'";
        
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        
        return false;
    }
}
?>