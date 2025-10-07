<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="../technician/css/dashboard.css">
</head>
<body>
    <div class="tech_dahboard">
        <div class="sidebar">
            
            <h2>Technician Panel</h2>
            <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="../technician/assignedtask.php">Assigned Tasks</a></li>
            <li><a href="../technician/view-feedback.php">Feedbacks</a></li>
            </ul>
            <button onclick="history.back()" class="backbutton" name="backbutton" >
        back
        </button>
            <form action="../includes/logout.php" method="POST">
            <button class="logout" name="logout">Logout</button>
        </form>
        </div>
        <div class="content">
            <h2> Welcome, <?php echo isset($_SESSION["name"]) ? $_SESSION["name"] : "Technician"; ?></h2>
            <div class="card-container">
                <div class="card">
                    <h5>Assigned Tasks</h5>
                    <p> <?php echo $assigned_count['total']; ?></p>
                    
                </div>
                <div class="card">
                    <h5>Completed Tasks</h5>
                    <p><?php echo $completed_count['completed']; ?></p>
                </div>
            </div>
        </div>
        <div class="techside">
            <h2>profile</h2> <br>
            <i class="fa-regular fa-user"></i> <br>
            <p id="techeid">Technician id:<?php echo isset($_SESSION["technicianid"]) ? $_SESSION["technicianid"] : "Technician-ID"; ?></p> <br>
            <p id="techname" name="techname"><?php echo isset($_SESSION["name"]) ? $_SESSION["name"] : "Technician"; ?></p> 
            <button class="attendance-button" id="attendanceBtn">Unavailable</button>           
        </div>        
    </div>
    <script src="https://kit.fontawesome.com/781c7c7d6c.js" crossorigin="anonymous"></script>
    <script src="../technician/js/attendancebtn.js"></script>
    <script>
    document.getElementById("attendanceBtn").addEventListener("click", function () {
        let btn = this;

        fetch("../technician/attendance.php", {
            method: "POST"
        })
        .then(response => response.text())
        .then(data => {
            if (data === "1") {
                btn.innerHTML = "Available";
                btn.style.backgroundColor = "green";
            } else if (data === "0") {
                btn.innerHTML = "Unavailable";
                btn.style.backgroundColor = "red";
            } else {
                console.error("Error updating status");
            }
        })
        .catch(error => console.error("Fetch Error:", error));
    });
</script>
</body>
</html>