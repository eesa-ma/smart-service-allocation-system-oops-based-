<?php
Class Technician {
    private $conn;
    public $name;
    public $skills;
    public $email;
    public $phoneno;
    public $address;
    public $availabilityStatus;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM technician WHERE Email = '$email'";
        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    public function createAccount() {
        $sql = "INSERT INTO technician (Name, Skills, Location, Phone_No, Email, Password)
        VALUES ('$this->name','$this->skills','$this->address','$this->phoneno','$this->email','$this->password')";
        
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
?>