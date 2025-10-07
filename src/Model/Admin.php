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

}
?>