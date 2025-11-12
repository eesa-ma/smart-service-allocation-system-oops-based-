<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require admin login
if (!isset($_SESSION['Admin_ID'])) {
    header('Location: admin-signin.php');
    exit();
}

// Include controller
include __DIR__ . '/../../src/Controllers/AdminController.php';

// Get message from session
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

// Get data from controller
$adminController = new AdminController();
$requests = $adminController->getPendingRequests();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Service Requests - Admin Panel</title>
    <link rel="stylesheet" href="css/manage-service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <i class="fas fa-tasks header-icon"></i>
                <div>
                    <h1>Manage Service Requests</h1>
                    <p class="subtitle">Assign technicians and manage service requests</p>
                    <?php if ($message): ?>
                        <p class="subtitle success-message"><?php echo htmlspecialchars($message); ?></p>
                    <?php endif; ?>
                </div>
            </div>  
            <button onclick="window.location.href='admin-dashboard.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </div>

        <div class="table-container">
            <table class="service-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> Request ID</th>
                        <th><i class="fas fa-user"></i> Customer</th>
                        <th><i class="fas fa-tools"></i> Service</th>
                        <th><i class="fas fa-map-marker-alt"></i> Location</th>
                        <th><i class="fas fa-user-cog"></i> Assign Technician</th>
                        <th><i class="fas fa-bolt"></i> Action</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $row): ?>
                            <tr>
                                <td class='id-cell'>#<?php echo str_pad($row['Request_ID'], 4, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class='description-cell'><?php echo htmlspecialchars($row['Description']); ?></td>
                                <td><?php echo htmlspecialchars($row['Location']); ?></td>
                                <td>
                                    <form method='post' action='../../src/Controllers/AdminController.php' class='assign-form'>
                                        <input type='hidden' name='action' value='assign_technician'>
                                        <input type='hidden' name='request_id' value='<?php echo $row['Request_ID']; ?>'>
                                        <select name='technician_id' class='tech-select' required>
                                            <option value=''>Select Technician</option>
                                            <?php 
                                            $technicians = $adminController->getAvailableTechnicians($row['Location']);
                                            foreach ($technicians as $tech): 
                                            ?>
                                                <option value='<?php echo $tech['Technician_ID']; ?>'>
                                                    <?php echo htmlspecialchars($tech['Name']) . ' - ' . htmlspecialchars($tech['Skills']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type='submit' class='btn btn-assign' title='Assign Technician'>
                                            <i class='fas fa-check'></i>
                                        </button>
                                    </form>
                                </td>
                                <td class='action-cell'>
                                    <form method='post' action='../../src/Controllers/AdminController.php' class='delete-form' onsubmit="return confirm('Are you sure you want to delete this request?')" style='display:inline'>
                                        <input type='hidden' name='action' value='delete_request'>
                                        <input type='hidden' name='request_id' value='<?php echo $row['Request_ID']; ?>'>
                                        <button type='submit' class='btn btn-delete' title='Delete Request'>
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <span class='status-badge status-<?php echo strtolower($row['Status']); ?>'>
                                        <?php echo htmlspecialchars($row['Status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan='7' class='no-data'>
                                <i class='fas fa-inbox'></i>
                                <p>No pending or rejected requests.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>