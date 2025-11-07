<?php 
    session_start();
    
    // Initialize variables to prevent warnings
    $total_orders = 0;
    $pending_orders = 0;
    
    // TODO: Fetch actual data from database
    // Example: $total_orders = count($serviceRequestModel->getOrdersByUserId($_SESSION['id']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Smart Service Allocation</title>
    <link rel="stylesheet" href="../user/css/dash.css?v=2.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li><a href="../../public/index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="../user/request-service.php"><i class="fas fa-plus-circle"></i> Request a Service</a></li>
                <li><a href="../user/track-service.php"><i class="fas fa-search"></i> Track Service Status</a></li>
                <li><a href="../user/user-feedback.php"><i class="fas fa-star"></i> Rating & Feedback</a></li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <button type="button" onclick="window.location.href='../../public/index.php'" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <form action="../includes/logout.php" method="POST">
                <button class="btn-logout" name="logout">
                    <i class="fas fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </div>
    
    <div class="main-content">
        <div class="topbar">
            <h1>Welcome, <?php echo isset($_SESSION["name"]) ? htmlspecialchars($_SESSION["name"]) : "User"; ?>!</h1>
            <p class="subtitle">Manage your service requests</p>
        </div>
        
        <div class="dashboard-cards">
            <div class="card card-primary">
                <div class="card-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-content">
                    <h3>Total Orders</h3>
                    <p class="card-number"><?php echo $total_orders; ?></p>
                </div>
            </div>
            
            <div class="card card-warning">
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card-content">
                    <h3>Pending Orders</h3>
                    <p class="card-number"><?php echo $pending_orders; ?></p>
                </div>
            </div>
            
            <div class="card card-success">
                <div class="card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="card-content">
                    <h3>Completed</h3>
                    <p class="card-number"><?php echo ($total_orders - $pending_orders); ?></p>
                </div>
            </div>
        </div>
        
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="../user/request-service.php" class="action-btn action-btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>New Service Request</span>
                </a>
                <a href="../user/track-service.php" class="action-btn action-btn-secondary">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Track Services</span>
                </a>
            </div>
        </div>
    </div>
    
    <button class="mobile-menu-toggle" id="menuToggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>