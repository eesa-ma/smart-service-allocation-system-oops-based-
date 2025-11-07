<?php 

// include_once '../Model/User.php';

   class serviceRequest {
    private $conn;
    //public $servicetype; 
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

        public function getAssignedTasks($technicianId) {
            $query = "SELECT r.Request_ID, u.name AS customer_name, 
                            u.Address, u.Phone_NO, r.Status
                    FROM service_request r
                    JOIN user u ON r.User_ID = u.user_ID
                    WHERE r.Technician_ID = '$technicianId' 
                    AND r.Status NOT IN ('Completed', 'Rejected')
                    ORDER BY r.Request_ID DESC";
            
            $result = mysqli_query($this->conn, $query);
            
            $tasks = [];
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $tasks[] = $row;
                }
            }
            
            return $tasks;
        }

        public function updateTaskStatus($requestId, $technicianId, $status) {
            $query = "UPDATE service_request 
                    SET Status = '$status' 
                    WHERE Request_ID = '$requestId' 
                    AND Technician_ID = '$technicianId'";
            
            if (mysqli_query($this->conn, $query)) {
                if ($status === 'Rejected') {
                    $clearQuery = "UPDATE service_request 
                                SET Technician_ID = NULL 
                                WHERE Request_ID = '$requestId'";
                    mysqli_query($this->conn, $clearQuery);
                }
                return true;
            }
            return false;
        }
    }
?>