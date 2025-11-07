<?php
session_start();

// Check if technician is logged in
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'technician') {
    header('Location: technician-signin.php');
    exit;
}

// Get assigned tasks
require_once __DIR__ . '/../../src/Core/Database.php';
require_once __DIR__ . '/../../src/Model/ServiceRequest.php';

$database = new Database();
$conn = $database->connect();

$serviceRequest = new ServiceRequest($conn);
$technicianId = $_SESSION['id'];
$technicianName = $_SESSION['name'] ?? 'Technician';

$tasks = $serviceRequest->getAssignedTasks($technicianId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Tasks</title>
    <link rel="stylesheet" href="css/assignedtask.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <i class="fas fa-tasks header-icon"></i>
                <div>
                    <h1>Assigned Tasks</h1>
                    <p class="subtitle">Manage your assigned service requests</p>
                </div>
            </div>
            <button onclick="window.location.href='technician-dashboard.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </div>

        <div class="table-container">
            <?php if (count($tasks) > 0): ?>
            <table class="tasks-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> Request ID</th>
                        <th><i class="fas fa-user"></i> Customer Name</th>
                        <th><i class="fas fa-map-marker-alt"></i> Location</th>
                        <th><i class="fas fa-phone"></i> Mobile Number</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-bolt"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td class="id-cell">#<?php echo str_pad($task['Request_ID'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo htmlspecialchars($task['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($task['Address']); ?></td>
                        <td><?php echo htmlspecialchars($task['Phone_NO']); ?></td>
                        <td>
                            <form action="../../src/Controllers/TechnicianController.php" method="POST" class="status-form">
                                <input type="hidden" name="action" value="update_status">
                                <input type="hidden" name="request_id" value="<?php echo $task['Request_ID']; ?>">
                                <select name="status" class="status-select" required>
                                    <option value="" disabled selected>Update Status</option>
                                    <option value="Accepted" <?php if ($task['Status'] == 'Accepted') echo 'selected'; ?>>Accepted</option>
                                    <option value="Rejected" <?php if ($task['Status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                                    <option value="Completed" <?php if ($task['Status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                </select>
                        </td>
                        <td>
                                <button type="submit" class="btn-update">
                                    <i class="fas fa-check"></i> Update
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-tasks">
                <i class="fas fa-inbox"></i>
                <p>No assigned tasks at the moment</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>