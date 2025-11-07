<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header('Location: user-signin.php');
    exit;
}

// Get user's service requests
require_once __DIR__ . '/../../src/Core/Database.php';
require_once __DIR__ . '/../../src/Model/ServiceRequest.php';

$database = new Database();
$conn = $database->connect();

$serviceRequest = new ServiceRequest($conn);
$userId = $_SESSION['id'];
$userName = $_SESSION['name'] ?? 'User';

$requests = $serviceRequest->getUserServiceRequests($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Service Status</title>
    <link rel="stylesheet" href="css/track-service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <i class="fas fa-search header-icon"></i>
                <div>
                    <h1>Track Your Service Status</h1>
                    <p class="subtitle">Monitor your service requests in real-time</p>
                </div>
            </div>
            <button onclick="window.location.href='user-dashboard.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </div>

        <div class="table-container">
            <?php if (count($requests) > 0): ?>
            <table class="track-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> Request ID</th>
                        <th><i class="fas fa-info-circle"></i> Description</th>
                        <th><i class="fas fa-map-marker-alt"></i> Location</th>
                        <th><i class="fas fa-tasks"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td class="id-cell">#<?php echo str_pad($request['Request_ID'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo htmlspecialchars($request['Description']); ?></td>
                        <td><?php echo htmlspecialchars($request['Location']); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo strtolower($request['Status']); ?>">
                                <?php 
                                    $status = $request['Status'];
                                    $icon = '';
                                    switch(strtolower($status)) {
                                        case 'pending':
                                            $icon = 'fa-clock';
                                            break;
                                        case 'assigned':
                                        case 'accepted':
                                            $icon = 'fa-user-check';
                                            break;
                                        case 'completed':
                                            $icon = 'fa-check-circle';
                                            break;
                                        case 'rejected':
                                            $icon = 'fa-times-circle';
                                            break;
                                        default:
                                            $icon = 'fa-info-circle';
                                    }
                                ?>
                                <i class="fas <?php echo $icon; ?>"></i>
                                <?php echo htmlspecialchars($status); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-requests">
                <i class="fas fa-inbox"></i>
                <p>You haven't made any service requests yet</p>
                <button onclick="window.location.href='request-service.php'" class="btn-new-request">
                    <i class="fas fa-plus"></i> Make a Request
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>