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


    public function toggleAvailabilityStatus($technicianId) {
    // Get current status
        $query = "SELECT Availability_Status FROM technician WHERE Technician_ID = '$technicianId'";
        $result = mysqli_query($this->conn, $query);
        
        if ($row = mysqli_fetch_assoc($result)) {
            // Toggle: 1 -> 0 or 0 -> 1
            $newStatus = ($row['Availability_Status'] == '1') ? '0' : '1';
            
            // Update database
            $updateQuery = "UPDATE technician SET Availability_Status = '$newStatus' WHERE Technician_ID = '$technicianId'";
            
            if (mysqli_query($this->conn, $updateQuery)) {
                return $newStatus;
            }
        }
        
        return 'error';
    }

    public function getAvailableTechniciansByLocation($location) {
    
        $sql = "SELECT Technician_ID, Name, Skills, Location
                FROM technician 
                WHERE Availability_Status = 1 
                AND Location LIKE ?
                ORDER BY Name";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        
        $technicians = [];
        if ($stmt) {
            $searchLocation = "%{$location}%";
            mysqli_stmt_bind_param($stmt, "s", $searchLocation);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            while ($row = mysqli_fetch_assoc($result)) {
                $technicians[] = $row;
            }
            
            mysqli_stmt_close($stmt);
        }
        
        return $technicians;
    }
    

    public function verifyEmail($email) {
        $query = "SELECT Technician_ID, Name, Email FROM technician WHERE Email = '$email'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        
        return false;
    }

    public function resetPassword($email, $newPassword) {
        $query = "UPDATE technician SET Password = '$newPassword' WHERE Email = '$email'";
        
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        
        return false;
    }
}
?>