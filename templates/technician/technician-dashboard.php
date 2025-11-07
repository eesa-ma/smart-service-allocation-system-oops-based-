<?php 
session_start();

// Session guard
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'technician') {
    header('Location: technician-signin.php');
    exit;
}

// Get technician data
require_once __DIR__ . '/../../src/Core/Database.php';
$db = new Database();
$conn = $db->connect();

$technicianID = $_SESSION['id'];
$technicianName = $_SESSION['name'] ?? 'Technician';

// Fetch task counts from service_request table
$assignedQuery = "SELECT COUNT(*) AS total FROM service_request WHERE Technician_ID = '$technicianID'";
$assignedResult = @mysqli_query($conn, $assignedQuery);
if (!$assignedResult) {
    $assigned_count = ['total' => 0];
} else {
    $assigned_count = mysqli_fetch_assoc($assignedResult) ?: ['total' => 0];
}

$completedQuery = "SELECT COUNT(*) AS completed FROM service_request WHERE Technician_ID = '$technicianID' AND Status = 'Completed'";
$completedResult = @mysqli_query($conn, $completedQuery);
if (!$completedResult) {
    $completed_count = ['completed' => 0];
} else {
    $completed_count = mysqli_fetch_assoc($completedResult) ?: ['completed' => 0];
}

// Fetch current availability status
$statusQuery = "SELECT Availability_Status FROM technician WHERE Technician_ID = '$technicianID'";
$statusResult = mysqli_query($conn, $statusQuery);
$statusData = mysqli_fetch_assoc($statusResult);
$currentStatus = $statusData['Availability_Status'] ?? '0';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css?v=2.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <i class="fas fa-wrench"></i>
            <span>Technician Panel</span>
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <nav>
            <ul class="nav-list">
                <li><a href="#home" class="active"><i class="fas fa-gauge"></i> Dashboard</a></li>
                <li><a href="../technician/assignedtask.php"><i class="fas fa-tasks"></i> Assigned Tasks</a></li>
                <li><a href="../technician/view-feedback.php"><i class="fas fa-comments"></i> Feedbacks</a></li>
            </ul>
        </nav>
        <div class="sidebar-actions">
            <button onclick="window.location.href='../../public/index.php'" class="btn back">
                <i class="fas fa-arrow-left"></i> Back to Home
            </button>
            <form action="../includes/logout.php" method="POST">
                <button class="btn logout" name="logout"><i class="fas fa-right-from-bracket"></i> Logout</button>
            </form>
        </div>
    </aside>

    <main class="main" id="home">
        <header class="topbar">
            <h1>Welcome, <?php echo htmlspecialchars($technicianName); ?></h1>
        </header>

        <section class="cards">
            <div class="card gradient-1">
                <div class="card-icon"><i class="fas fa-clipboard-list"></i></div>
                <div class="card-content">
                    <span class="card-label">Assigned Tasks</span>
                    <span class="card-value"><?php echo $assigned_count['total']; ?></span>
                </div>
            </div>
            <div class="card gradient-2">
                <div class="card-icon"><i class="fas fa-check-circle"></i></div>
                <div class="card-content">
                    <span class="card-label">Completed Tasks</span>
                    <span class="card-value"><?php echo $completed_count['completed']; ?></span>
                </div>
            </div>
        </section>

        <section class="profile-card">
            <div class="profile-header">
                <i class="fas fa-user-circle profile-icon"></i>
                <div class="profile-info">
                    <h2><?php echo htmlspecialchars($technicianName); ?></h2>
                    <p>Technician ID: <?php echo htmlspecialchars($technicianID); ?></p>
                </div>
            </div>
            <div class="availability-section">
                <label for="availabilityToggle">Availability Status</label>
                <button class="availability-btn <?php echo $currentStatus == '1' ? 'available' : 'unavailable'; ?>" 
                        id="availabilityToggle">
                    <i class="fas <?php echo $currentStatus == '1' ? 'fa-circle-check' : 'fa-circle-xmark'; ?>"></i>
                    <span><?php echo $currentStatus == '1' ? 'Available' : 'Unavailable'; ?></span>
                </button>
            </div>
        </section>

        <section class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="actions-grid">
                <a class="action" href="../technician/assignedtask.php"><i class="fas fa-list-check"></i> View Tasks</a>
                <a class="action" href="../technician/view-feedback.php"><i class="fas fa-star"></i> Check Feedback</a>
            </div>
        </section>
    </main>

    <script>
        // Mobile sidebar toggle
        const toggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.querySelector('.sidebar');
        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        }

        // Availability toggle
        const availabilityBtn = document.getElementById('availabilityToggle');
        availabilityBtn.addEventListener('click', function() {
            fetch('../technician/attendance.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(data => {
                const icon = this.querySelector('i');
                const text = this.querySelector('span');
                
                if (data === '1') {
                    this.classList.remove('unavailable');
                    this.classList.add('available');
                    icon.className = 'fas fa-circle-check';
                    text.textContent = 'Available';
                } else if (data === '0') {
                    this.classList.remove('available');
                    this.classList.add('unavailable');
                    icon.className = 'fas fa-circle-xmark';
                    text.textContent = 'Unavailable';
                } else {
                    console.error('Error updating status');
                }
            })
            .catch(error => console.error('Fetch Error:', error));
        });
    </script>
    <script src="../technician/js/attendance.js"></script>
</body>
</html>