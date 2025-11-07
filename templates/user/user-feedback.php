<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header('Location: user-signin.php');
    exit;
}

// Get completed requests
require_once __DIR__ . '/../../src/Core/Database.php';
require_once __DIR__ . '/../../src/Model/Feedback.php';

$database = new Database();
$conn = $database->connect();

$feedback = new Feedback($conn);
$userId = $_SESSION['id'];
$userName = $_SESSION['name'] ?? 'User';

$completedRequests = $feedback->getCompletedRequests($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback & Rating</title>
    <link rel="stylesheet" href="css/user-feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <i class="fas fa-star header-icon"></i>
                <div>
                    <h1>Submit Feedback & Rating</h1>
                    <p class="subtitle">Share your experience with our service</p>
                </div>
            </div>
            <button onclick="window.location.href='user-dashboard.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </div>

        <div class="form-container">
            <?php if (count($completedRequests) > 0): ?>
            <form action="../../src/Controllers/FeedbackController.php" method="POST" class="feedback-form" id="feedbackForm">
                <input type="hidden" name="action" value="submit_feedback">
                
                <div class="form-group">
                    <label for="request_id">
                        <i class="fas fa-clipboard-list"></i>
                        Select Completed Service
                    </label>
                    <select name="request_id" id="request_id" onchange="showServiceDetails()" required>
                        <option value="">-- Select a Service --</option>
                        <?php foreach ($completedRequests as $request): ?>
                            <option value="<?php echo $request['Request_ID']; ?>" 
                                    data-desc="<?php echo htmlspecialchars($request['Description']); ?>">
                                Request #<?php echo str_pad($request['Request_ID'], 4, '0', STR_PAD_LEFT); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p id="serviceDetails" class="service-detail"></p>
                </div>

                <div class="form-group">
                    <label for="rating">
                        <i class="fas fa-star"></i>
                        Rating
                    </label>
                    <div class="star-rating">
                        <input type="radio" name="rating" value="5" id="star5" required>
                        <label for="star5" title="5 stars">
                            <i class="fas fa-star"></i>
                        </label>
                        
                        <input type="radio" name="rating" value="4" id="star4">
                        <label for="star4" title="4 stars">
                            <i class="fas fa-star"></i>
                        </label>
                        
                        <input type="radio" name="rating" value="3" id="star3">
                        <label for="star3" title="3 stars">
                            <i class="fas fa-star"></i>
                        </label>
                        
                        <input type="radio" name="rating" value="2" id="star2">
                        <label for="star2" title="2 stars">
                            <i class="fas fa-star"></i>
                        </label>
                        
                        <input type="radio" name="rating" value="1" id="star1">
                        <label for="star1" title="1 star">
                            <i class="fas fa-star"></i>
                        </label>
                    </div>
                    <p class="rating-text">Click on stars to rate</p>
                </div>

                <div class="form-group">
                    <label for="comments">
                        <i class="fas fa-comment"></i>
                        Comments
                    </label>
                    <textarea name="comments" id="comments" rows="5" 
                              placeholder="Share your experience with our service..." required></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i>
                    Submit Feedback
                </button>
            </form>
            <?php else: ?>
            <div class="no-completed">
                <i class="fas fa-clipboard-check"></i>
                <p>You don't have any completed services yet</p>
                <p class="sub-text">Feedback can only be submitted for completed services</p>
                <button onclick="window.location.href='request-service.php'" class="btn-new-request">
                    <i class="fas fa-plus"></i> Request a Service
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>

       </div>

    <script src="../user/js/rating.js"></script>
</body>
</html>