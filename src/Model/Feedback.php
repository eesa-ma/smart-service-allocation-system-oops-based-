<?php

class Feedback {
    private $conn;
    public $userId;
    public $requestId;
    public $rating;
    public $comments;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Get completed service requests for a user (for feedback)
     */
    public function getCompletedRequests($userId) {
        $query = "SELECT Request_ID, Description 
                  FROM service_request 
                  WHERE User_ID = '$userId' 
                  AND Status = 'Completed'
                  ORDER BY Request_ID DESC";
        
        $result = mysqli_query($this->conn, $query);
        
        $requests = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $requests[] = $row;
            }
        }
        
        return $requests;
    }

    /**
     * Submit feedback
     */
    public function submitFeedback() {
        $query = "INSERT INTO feedback (User_ID, Request_ID, Rating, Comments) 
                  VALUES ('$this->userId', '$this->requestId', '$this->rating', '$this->comments')";
        
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        
        return false;
    }

    /**
     * Check if feedback already exists for a request
     */
    public function feedbackExists($userId, $requestId) {
        $query = "SELECT Feedback_ID FROM feedback 
                  WHERE User_ID = '$userId' AND Request_ID = '$requestId'";
        
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }
        
        return false;
    }
}
?>