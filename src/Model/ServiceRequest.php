<?php 

// include_once '../Model/User.php';

   class serviceRequest {
    private $conn;
    //public $servicetype; add service type also
    public $description;
    public $location;
    public $status;
    public $userID;

    public function __construct($db) {
            $this->conn = $db;
        } 

    public function addrequest() {
        $sql = "INSERT INTO service_request (Description, Location, Status, User_ID) 
                VALUES ('$this->description', '$this->location', 'Pending', '$this->userID')";
        
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
                return false;
            }
        }
    }
?>