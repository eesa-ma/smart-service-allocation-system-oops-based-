<?php
session_start();

// Check if technician is logged in
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'technician') {
    header('Location: technician-signin.php');
    exit;
}

// Get technician's feedback
require_once __DIR__ . '/../../src/Core/Database.php';
require_once __DIR__ . '/../../src/Model/Feedback.php';

$database = new Database();
$conn = $database->connect();

$feedbackModel = new Feedback($conn);
$technicianId = $_SESSION['id'];
$technicianName = $_SESSION['name'] ?? 'Technician';

$feedbacks = $feedbackModel->getTechnicianFeedback($technicianId);
$stats = $feedbackModel->getTechnicianFeedbackStats($technicianId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Feedback - Technician</title>
    <link rel="stylesheet" href="css/view-feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <i class="fas fa-star header-icon"></i>
                <div>
                    <h1>My Service Feedback</h1>
                    <p class="subtitle">See what customers are saying about your work</p>
                </div>
            </div>
            <button onclick="window.location.href='technician-dashboard.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card card-purple">
                <div class="stat-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="stat-info">
                    <p>Total Feedback</p>
                    <h3><?php echo $stats['total']; ?></h3>
                </div>
            </div>
            
            <div class="stat-card card-gold">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-info">
                    <p>Average Rating</p>
                    <h3>
                        <?php echo $stats['average_rating']; ?> 
                        <span class="out-of">/ 5</span>
                    </h3>
                </div>
            </div>
            
            <div class="stat-card card-green">
                <div class="stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-info">
                    <p>5-Star Reviews</p>
                    <h3><?php echo $stats['five_star']; ?></h3>
                </div>
            </div>
            
            <div class="stat-card card-blue">
                <div class="stat-icon">
                    <i class="fas fa-thumbs-up"></i>
                </div>
                <div class="stat-info">
                    <p>4-Star Reviews</p>
                    <h3><?php echo $stats['four_star']; ?></h3>
                </div>
            </div>
        </div>

        <!-- Performance Bar -->
        <?php if ($stats['total'] > 0): ?>
        <div class="performance-section">
            <h2><i class="fas fa-chart-bar"></i> Performance Overview</h2>
            <div class="rating-bars">
                <?php for ($i = 5; $i >= 1; $i--): 
                    $count = $stats[$i == 1 ? 'one_star' : ($i == 2 ? 'two_star' : ($i == 3 ? 'three_star' : ($i == 4 ? 'four_star' : 'five_star')))];
                    $percentage = $stats['total'] > 0 ? ($count / $stats['total']) * 100 : 0;
                ?>
                <div class="rating-bar-row">
                    <span class="rating-label"><?php echo $i; ?> <i class="fas fa-star"></i></span>
                    <div class="bar-container">
                        <div class="bar-fill" style="width: <?php echo $percentage; ?>%"></div>
                    </div>
                    <span class="rating-count"><?php echo $count; ?></span>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Feedback List -->
        <div class="feedback-section">
            <h2><i class="fas fa-comments"></i> Customer Reviews</h2>
            
            <?php if (count($feedbacks) > 0): ?>
            <div class="feedback-list">
                <?php foreach ($feedbacks as $feedback): ?>
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="user-info">
                            <div class="user-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="user-details">
                                <h4><?php echo htmlspecialchars($feedback['User_Name']); ?></h4>
                                <p class="service-info">
                                    <i class="fas fa-wrench"></i>
                                    <?php echo htmlspecialchars($feedback['Service_Description']); ?>
                                </p>
                            </div>
                        </div>
                        <div class="feedback-meta">
                            <div class="rating-stars">
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
                            </div>
                            <p class="feedback-date">
                                <i class="fas fa-calendar"></i>
                                <?php echo date('M d, Y', strtotime($feedback['created_at'])); ?>
                            </p>
                        </div>
                    </div>
                    <div class="feedback-body">
                        <p class="comment-text">
                            <i class="fas fa-quote-left quote-icon"></i>
                            <?php echo htmlspecialchars($feedback['Comments']); ?>
                            <i class="fas fa-quote-right quote-icon"></i>
                        </p>
                    </div>
                    <div class="feedback-footer">
                        <span class="request-badge">
                            <i class="fas fa-hashtag"></i>
                            Request <?php echo str_pad($feedback['Request_ID'], 4, '0', STR_PAD_LEFT); ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="no-feedback">
                <i class="fas fa-inbox"></i>
                <p>No feedback received yet</p>
                <p class="sub-text">Complete more services to receive customer reviews</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>