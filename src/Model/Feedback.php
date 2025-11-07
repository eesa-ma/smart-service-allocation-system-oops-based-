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

    
    public function submitFeedback() {
        $query = "INSERT INTO feedback (User_ID, Request_ID, Rating, Comments) 
                  VALUES ('$this->userId', '$this->requestId', '$this->rating', '$this->comments')";
        
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        
        return false;
    }

    
    public function feedbackExists($userId, $requestId) {
        $query = "SELECT Feedback_ID FROM feedback 
                  WHERE User_ID = '$userId' AND Request_ID = '$requestId'";
        
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }
        
        return false;
    }

   
public function getAllFeedback() {
    $query = "SELECT f.Feedback_ID, f.Comments, f.Rating, f.Request_ID, f.created_at,
                     u.Name AS User_Name, 
                     t.Name AS Technician_Name,
                     sr.Description AS Service_Description
              FROM feedback f
              JOIN service_request sr ON f.Request_ID = sr.Request_ID
              JOIN user u ON f.User_ID = u.User_ID
              LEFT JOIN technician t ON sr.Technician_ID = t.Technician_ID
              ORDER BY f.created_at DESC";
    
    $result = mysqli_query($this->conn, $query);
    
    $feedbacks = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $feedbacks[] = $row;
        }
    }
    
    return $feedbacks;
}

public function getFeedbackStats() {
        $stats = [
            'total' => 0,
            'average_rating' => 0,
            'five_star' => 0,
            'four_star' => 0,
            'three_star' => 0,
            'two_star' => 0,
            'one_star' => 0
        ];
        
        // Total feedback count
        $totalQuery = "SELECT COUNT(*) as total FROM feedback";
        $totalResult = mysqli_query($this->conn, $totalQuery);
        if ($totalResult) {
            $stats['total'] = mysqli_fetch_assoc($totalResult)['total'];
        }
        
        // Average rating
        $avgQuery = "SELECT AVG(Rating) as avg_rating FROM feedback";
        $avgResult = mysqli_query($this->conn, $avgQuery);
        if ($avgResult) {
            $stats['average_rating'] = round(mysqli_fetch_assoc($avgResult)['avg_rating'], 1);
        }
        
        // Rating distribution
        for ($i = 1; $i <= 5; $i++) {
            $ratingQuery = "SELECT COUNT(*) as count FROM feedback WHERE Rating = $i";
            $ratingResult = mysqli_query($this->conn, $ratingQuery);
            if ($ratingResult) {
                $key = $i == 1 ? 'one_star' : ($i == 2 ? 'two_star' : ($i == 3 ? 'three_star' : ($i == 4 ? 'four_star' : 'five_star')));
                $stats[$key] = mysqli_fetch_assoc($ratingResult)['count'];
            }
        }
        
        return $stats;
    }

    // Add this method to your existing Feedback class

public function getTechnicianFeedback($technicianId) {
    $query = "SELECT f.Feedback_ID, f.Comments, f.Rating, f.Request_ID, f.created_at,
                     u.Name AS User_Name,
                     sr.Description AS Service_Description
              FROM feedback f
              JOIN service_request sr ON f.Request_ID = sr.Request_ID
              JOIN user u ON f.User_ID = u.User_ID
              WHERE sr.Technician_ID = '$technicianId'
              ORDER BY f.created_at DESC";
    
    $result = mysqli_query($this->conn, $query);
    
    $feedbacks = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $feedbacks[] = $row;
        }
    }
    
    return $feedbacks;
}

public function getTechnicianFeedbackStats($technicianId) {
        $stats = [
            'total' => 0,
            'average_rating' => 0,
            'five_star' => 0,
            'four_star' => 0,
            'three_star' => 0,
            'two_star' => 0,
            'one_star' => 0
        ];
        
        // Total feedback count for this technician
        $totalQuery = "SELECT COUNT(*) as total 
                    FROM feedback f
                    JOIN service_request sr ON f.Request_ID = sr.Request_ID
                    WHERE sr.Technician_ID = '$technicianId'";
        $totalResult = mysqli_query($this->conn, $totalQuery);
        if ($totalResult) {
            $stats['total'] = mysqli_fetch_assoc($totalResult)['total'];
        }
        
        // Average rating for this technician
        $avgQuery = "SELECT AVG(f.Rating) as avg_rating 
                    FROM feedback f
                    JOIN service_request sr ON f.Request_ID = sr.Request_ID
                    WHERE sr.Technician_ID = '$technicianId'";
        $avgResult = mysqli_query($this->conn, $avgQuery);
        if ($avgResult) {
            $avg = mysqli_fetch_assoc($avgResult)['avg_rating'];
            $stats['average_rating'] = $avg ? round($avg, 1) : 0;
        }
        
        // Rating distribution for this technician
        for ($i = 1; $i <= 5; $i++) {
            $ratingQuery = "SELECT COUNT(*) as count 
                            FROM feedback f
                            JOIN service_request sr ON f.Request_ID = sr.Request_ID
                            WHERE sr.Technician_ID = '$technicianId' AND f.Rating = $i";
            $ratingResult = mysqli_query($this->conn, $ratingQuery);
            if ($ratingResult) {
                $key = $i == 1 ? 'one_star' : ($i == 2 ? 'two_star' : ($i == 3 ? 'three_star' : ($i == 4 ? 'four_star' : 'five_star')));
                $stats[$key] = mysqli_fetch_assoc($ratingResult)['count'];
            }
        }
        
        return $stats;
    }
}
?>