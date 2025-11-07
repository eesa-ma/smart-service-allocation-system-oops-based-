<?php
session_start();
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Model/Technician.php';

class TechnicianController {
    private $conn;
    private $technician;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        $this->technician = new Technician($this->conn);
    }

    public function toggleAvailability() {
        // Check if technician is logged in
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'technician') {
            echo 'error';
            exit;
        }

        $technicianId = $_SESSION['id'];
        
        // Call model to toggle availability
        $newStatus = $this->technician->toggleAvailabilityStatus($technicianId);
        
        echo $newStatus; // Return '0', '1', or 'error'
        exit;
    }

    public function updateTaskStatus() {
    
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'technician') {
            echo "<script>alert('Unauthorized access'); window.location.href='../../templates/technician/technician-signin.php';</script>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestId = $_POST['request_id'];
            $status = $_POST['status'];
            $technicianId = $_SESSION['id'];

            require_once __DIR__ . '/../Model/ServiceRequest.php';
            $serviceRequest = new ServiceRequest($this->conn);

            if ($serviceRequest->updateTaskStatus($requestId, $technicianId, $status)) {
                echo "<script>alert('Status updated successfully!'); window.location.href='../../templates/technician/assignedtask.php';</script>";
            } else {
                echo "<script>alert('Failed to update status.'); window.location.href='../../templates/technician/assignedtask.php';</script>";
            }
        }
    }
}

// ROUTER - Handle incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TechnicianController();
    
    if (isset($_POST['action'])) {
        // Toggle availability
        if ($_POST['action'] === 'toggle_availability') {
            $controller->toggleAvailability();
        }
        // Update task status
        elseif ($_POST['action'] === 'update_status') {
            $controller->updateTaskStatus();
        }
    }
}
?>