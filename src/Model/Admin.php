<?php 
class Admin {
    private $conn;
    public $adminID;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findbyAdminID($adminID) {
        $sql = "SELECT * FROM admin WHERE Admin_ID = '$adminID'";
        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    public function verifyAdminId($adminId) {
        $query = "SELECT Admin_ID FROM admin WHERE Admin_ID = '$adminId'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        
        return false;
    }

     public function resetPassword($adminId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE admin SET Password = '$hashedPassword' WHERE Admin_ID = '$adminId'";
        
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        
        return false;
    }

}
?>