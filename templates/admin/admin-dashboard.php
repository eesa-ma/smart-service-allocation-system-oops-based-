<?php
// Session guard
session_start();
if (!isset($_SESSION['Admin_ID'])) {
    header('Location: admin-signin.php');
    exit;
}

// Lightweight metrics (counts)
require_once __DIR__ . '/../../src/Core/Database.php';
$db = new Database();
$conn = $db->connect();

function count_rows($conn, $table, $where = '') {
    $sql = "SELECT COUNT(*) AS c FROM $table" . ($where ? " WHERE $where" : '');
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        return (int)($row['c'] ?? 0);
    }
    return 0;
}

$totalUsers        = count_rows($conn, '`user`');
$totalTechnicians  = count_rows($conn, 'technician');
$totalRequests     = count_rows($conn, 'service_request');
$pendingRequests   = count_rows($conn, 'service_request', "Status='Pending'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <i class="fas fa-user-shield"></i>
            <span>Admin Panel</span>
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <nav>
            <ul class="nav-list">
                <li><a href="#home" class="active"><i class="fas fa-gauge"></i> Dashboard</a></li>
                <li><a href="../admin/manage-service.php"><i class="fas fa-tools"></i> Manage Services</a></li>
                <li><a href="../admin/Add-technician.php"><i class="fas fa-user-plus"></i> Add Technician</a></li>
                <li><a href="../admin/track-service.php"><i class="fas fa-location-dot"></i> Track Service</a></li>
                <li><a href="../admin/admin-feedback.php"><i class="fas fa-comments"></i> Feedbacks</a></li>
            </ul>
        </nav>
        <div class="sidebar-actions">
            <button onclick="window.location.href='../../public/index.php'" class="btn back">
                <i class="fas fa-arrow-left"></i> Back to Home
            </button>
           <form action="../includes/logout.php" method="POST">
                <button class="btn logout" name="logout">
                     <i class="fas fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main" id="home">
        <header class="topbar">
            <h1>Welcome, Admin</h1>
        </header>

        <section class="cards">
            <div class="card gradient-1">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div class="card-content">
                    <span class="card-label">Total Users</span>
                    <span class="card-value"><?php echo $totalUsers; ?></span>
                </div>
            </div>
            <div class="card gradient-2">
                <div class="card-icon"><i class="fas fa-user-cog"></i></div>
                <div class="card-content">
                    <span class="card-label">Technicians</span>
                    <span class="card-value"><?php echo $totalTechnicians; ?></span>
                </div>
            </div>
            <div class="card gradient-3">
                <div class="card-icon"><i class="fas fa-clipboard-list"></i></div>
                <div class="card-content">
                    <span class="card-label">Service Requests</span>
                    <span class="card-value"><?php echo $totalRequests; ?></span>
                </div>
            </div>
            <div class="card gradient-4">
                <div class="card-icon"><i class="fas fa-hourglass-half"></i></div>
                <div class="card-content">
                    <span class="card-label">Pending</span>
                    <span class="card-value"><?php echo $pendingRequests; ?></span>
                </div>
            </div>
        </section>

        <section class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="actions-grid">
                <a class="action" href="../admin/Add-technician.php"><i class="fas fa-user-plus"></i> Add Technician</a>
                <a class="action" href="../admin/manage-service.php"><i class="fas fa-screwdriver-wrench"></i> Manage Services</a>
                <a class="action" href="../admin/track-service.php"><i class="fas fa-route"></i> Track Requests</a>
                <a class="action" href="../admin/admin-feedback.php"><i class="fas fa-comment-dots"></i> Review Feedbacks</a>
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
    </script>
</body>
</html>