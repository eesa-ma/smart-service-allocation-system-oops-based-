<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['Admin_ID'])) {
    header('Location: admin-signin.php');
    exit;
}

// Get all feedback
require_once __DIR__ . '/../../src/Core/Database.php';
require_once __DIR__ . '/../../src/Model/Feedback.php';

$database = new Database();
$conn = $database->connect();

$feedbackModel = new Feedback($conn);
$feedbacks = $feedbackModel->getAllFeedback();
$stats = $feedbackModel->getFeedbackStats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Feedback - Admin</title>
    <link rel="stylesheet" href="css/admin-feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <i class="fas fa-comments header-icon"></i>
                <div>
                    <h1>Customer Feedback & Ratings</h1>
                    <p class="subtitle">Monitor customer satisfaction and service quality</p>
                </div>
            </div>
            <button onclick="window.location.href='admin-dashboard.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="stat-info">
                    <p>Total Feedback</p>
                    <h3><?php echo $stats['total']; ?></h3>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                    <p>Average Rating</p>
                    <h3><?php echo $stats['average_rating']; ?> <span class="out-of">/ 5</span></h3>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-award"></i>
                </div>
                <div class="stat-info">
                    <p>5-Star Ratings</p>
                    <h3><?php echo $stats['five_star']; ?></h3>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <p>4-Star Ratings</p>
                    <h3><?php echo $stats['four_star']; ?></h3>
                </div>
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="table-container">
            <?php if (count($feedbacks) > 0): ?>
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> Feedback ID</th>
                        <th><i class="fas fa-user"></i> Customer</th>
                        <th><i class="fas fa-user-cog"></i> Technician</th>
                        <th><i class="fas fa-clipboard"></i> Request ID</th>
                        <th><i class="fas fa-info-circle"></i> Service</th>
                        <th><i class="fas fa-star"></i> Rating</th>
                        <th><i class="fas fa-comment"></i> Comments</th>
                        <th><i class="fas fa-calendar"></i> Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td class="id-cell">#<?php echo str_pad($feedback['Feedback_ID'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo htmlspecialchars($feedback['User_Name']); ?></td>
                        <td>
                            <?php if ($feedback['Technician_Name']): ?>
                                <span class="tech-assigned">
                                    <?php echo htmlspecialchars($feedback['Technician_Name']); ?>
                                </span>
                            <?php else: ?>
                                <span class="no-tech">Not Assigned</span>
                            <?php endif; ?>
                        </td>
                        <td class="request-id">#<?php echo str_pad($feedback['Request_ID'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td class="service-desc"><?php echo htmlspecialchars($feedback['Service_Description']); ?></td>
                        <td>
                            <div class="rating-display">
                                <?php 
                                $rating = $feedback['Rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<i class="fas fa-star star-filled"></i>';
                                    } else {
                                        echo '<i class="fas fa-star star-empty"></i>';
                                    }
                                }
                                ?>
                                <span class="rating-number"><?php echo $rating; ?>/5</span>
                            </div>
                        </td>
                        <td class="comments-cell">
                            <div class="comment-text">
                                <?php echo htmlspecialchars($feedback['Comments']); ?>
                            </div>
                        </td>
                        <td class="date-cell">
                            <?php echo date('M d, Y', strtotime($feedback['created_at'])); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-feedback">
                <i class="fas fa-inbox"></i>
                <p>No feedback received yet</p>
                <p class="sub-text">Feedback will appear here once customers submit their reviews</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>