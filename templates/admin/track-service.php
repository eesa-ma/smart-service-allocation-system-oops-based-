<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['Admin_ID'])) {
    header('Location: admin-signin.php');
    exit;
}

// Get all service requests
require_once __DIR__ . '/../../src/Core/Database.php';
require_once __DIR__ . '/../../src/Model/ServiceRequest.php';

$database = new Database();
$conn = $database->connect();

$serviceRequest = new ServiceRequest($conn);
$requests = $serviceRequest->getAllServiceRequests();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track All Services - Admin</title>
    <link rel="stylesheet" href="css/track-service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <i class="fas fa-route header-icon"></i>
                <div>
                    <h1>Track All Service Requests</h1>
                    <p class="subtitle">Monitor all service requests in the system</p>
                </div>
            </div>
            <button onclick="window.location.href='admin-dashboard.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <i class="fas fa-clipboard-list"></i>
                <div>
                    <p>Total Requests</p>
                    <h3><?php echo count($requests); ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <div>
                    <p>Pending</p>
                    <h3><?php echo count(array_filter($requests, fn($r) => $r['Status'] == 'Pending' || $r['Status'] == 'Rejected')); ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-spinner"></i>
                <div>
                    <p>In Progress</p>
                    <h3><?php echo count(array_filter($requests, fn($r) => $r['Status'] == 'Assigned' || $r['Status'] == 'Accepted')); ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle"></i>
                <div>
                    <p>Completed</p>
                    <h3><?php echo count(array_filter($requests, fn($r) => $r['Status'] == 'Completed')); ?></h3>
                </div>
            </div>
        </div>

        <div class="table-container">
            <?php if (count($requests) > 0): ?>
            <table class="track-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-user"></i> Customer</th>
                        <th><i class="fas fa-phone"></i> Phone</th>
                        <th><i class="fas fa-info-circle"></i> Description</th>
                        <th><i class="fas fa-map-marker-alt"></i> Location</th>
                        <th><i class="fas fa-user-cog"></i> Technician</th>
                        <th><i class="fas fa-tasks"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td class="id-cell">#<?php echo str_pad($request['Request_ID'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo htmlspecialchars($request['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($request['Phone_NO']); ?></td>
                        <td class="description-cell"><?php echo htmlspecialchars($request['Description']); ?></td>
                        <td><?php echo htmlspecialchars($request['Location']); ?></td>
                        <td>
                            <?php if ($request['technician_name']): ?>
                                <span class="technician-assigned">
                                    <i class="fas fa-user-check"></i>
                                    <?php echo htmlspecialchars($request['technician_name']); ?>
                                </span>
                            <?php else: ?>
                                <span class="no-technician">
                                    <i class="fas fa-user-times"></i>
                                    Not Assigned
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php 
                                $status = $request['Status'];
                                $displayStatus = $status; // Default: show as-is
                                $icon = '';
                                
                                // Transform status for display
                                $statusLower = strtolower($status);
                                
                                switch($statusLower) {
                                    case 'pending':
                                        $icon = 'fa-clock';
                                        $displayStatus = 'Pending';
                                        break;
                                    case 'assigned':
                                    case 'accepted':
                                        $icon = 'fa-spinner fa-spin';
                                        $displayStatus = 'In Progress';
                                        $statusLower = 'inprogress'; // for CSS class
                                        break;
                                    case 'completed':
                                        $icon = 'fa-check-circle';
                                        $displayStatus = 'Completed';
                                        break;
                                    case 'rejected':
                                        $icon = 'fa-clock';
                                        $displayStatus = 'Pending';
                                        $statusLower = 'pending'; // for CSS class
                                        break;
                                    default:
                                        $icon = 'fa-info-circle';
                                }
                            ?>
                            <span class="status-badge status-<?php echo $statusLower; ?>">
                                <i class="fas <?php echo $icon; ?>"></i>
                                <?php echo htmlspecialchars($displayStatus); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-requests">
                <i class="fas fa-inbox"></i>
                <p>No service requests in the system yet</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>