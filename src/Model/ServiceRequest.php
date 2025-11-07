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

        public function assignTechnician($request_id, $technician_id) {
            $sql = "UPDATE service_request 
                    SET Technician_ID = ?, Status = 'Assigned' 
                    WHERE Request_ID = ?";
            
            $stmt = mysqli_prepare($this->conn, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ii", $technician_id, $request_id);
                $result = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                return $result;
            }
            
            return false;
        }

        public function deleteRequest($request_id) {
            $sql = "DELETE FROM service_request WHERE Request_ID = ?";
            
            $stmt = mysqli_prepare($this->conn, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $request_id);
                $result = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                return $result;
            }
            
            return false;
        }

        public function getPendingAndRejectedRequests() {
            $sql = "SELECT sr.Request_ID, u.name, sr.Description, sr.Location, 
                        sr.Technician_ID, sr.Status
                    FROM service_request sr 
                    JOIN user u ON sr.User_ID = u.user_ID
                    WHERE sr.Status IN ('Pending', 'Rejected')
                    ORDER BY sr.Request_ID DESC";
            
            $result = mysqli_query($this->conn, $sql);
            
            $requests = [];
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $requests[] = $row;
                }
            }
            
            return $requests;
        }
    }
?>