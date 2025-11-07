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
}

// Route the request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'toggle_availability') {
    $controller = new TechnicianController();
    $controller->toggleAvailability();
}
?>