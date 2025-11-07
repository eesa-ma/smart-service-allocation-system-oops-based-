<?php
session_start();
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Model/Feedback.php';

class FeedbackController {
    private $conn;
    private $feedback;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        $this->feedback = new Feedback($this->conn);
    }

    public function submitFeedback() {
        // Check if user is logged in
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
            echo "<script>alert('Unauthorized access'); window.location.href='../../templates/user/user-signin.php';</script>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['id'];
            $requestId = $_POST['request_id'];
            $rating = $_POST['rating'];
            $comments = $_POST['comments'];

            // Check if feedback already exists
            if ($this->feedback->feedbackExists($userId, $requestId)) {
                echo "<script>alert('You have already submitted feedback for this request!'); window.location.href='../../templates/user/user-feedback.php';</script>";
                exit;
            }

            // Set feedback data
            $this->feedback->userId = $userId;
            $this->feedback->requestId = $requestId;
            $this->feedback->rating = $rating;
            $this->feedback->comments = $comments;

            // Submit feedback
            if ($this->feedback->submitFeedback()) {
                echo "<script>alert('Feedback submitted successfully!'); window.location.href='../../templates/user/user-dashboard.php';</script>";
            } else {
                echo "<script>alert('Failed to submit feedback.'); window.location.href='../../templates/user/user-feedback.php';</script>";
            }
        }
    }
}

// Router
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_feedback') {
    $controller = new FeedbackController();
    $controller->submitFeedback();
}
?>