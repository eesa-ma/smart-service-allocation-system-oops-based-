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
        
    $sql = "INSERT INTO `user` (Name, Email, Phone_No, Address, Password) 
        VALUES ('$this->name', '$this->email', '$this->phoneNo', '$this->address', '$this->password')";

        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
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
        $query = "UPDATE user SET Password = '$newPassword' WHERE Email = '$email'";
        
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        
        return false;
    }
}
?>