<?php 
    session_start();
    
    // Check if user is logged in
    if (!isset($_SESSION['id'])) {
        header("Location: user-signin.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request - Smart Service Allocation</title>
    <link rel="stylesheet" href="css/request-service.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <div class="form-header">
                <i class="fas fa-tools"></i>
                <h2>Service Request Form</h2>
                <p>Fill out the form below to request a service</p>
            </div>
            
            <form action="../../src/Controllers/UserController.php" method="POST" id="serviceForm">
                <input type="hidden" name="action" value="request_service">
                
                <div class="form-group">
                    <label for="serviceType">
                        <i class="fas fa-wrench"></i> Type of Service
                    </label>
                    <select id="serviceType" name="serviceType" required>
                        <option value="">Select a service type</option>
                        <option value="electronics-repair">Electronics Repair</option>
                        <option value="device-installation">Device Installation & Setup</option>
                        <option value="technical-troubleshooting">Technical Troubleshooting</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="description">
                        <i class="fas fa-file-alt"></i> Service Description
                    </label>
                    <textarea id="description" name="description" rows="4" placeholder="Describe the service you need in detail..." required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="location">
                        <i class="fas fa-map-marker-alt"></i> District
                    </label>
                    <select id="location" name="location" required>
                        <option value="">Select your district</option>
                        <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                        <option value="Kollam">Kollam</option>
                        <option value="Pathanamthitta">Pathanamthitta</option>
                        <option value="Alappuzha">Alappuzha</option>
                        <option value="Kottayam">Kottayam</option>
                        <option value="Idukki">Idukki</option>
                        <option value="Ernakulam">Ernakulam</option>
                        <option value="Thrissur">Thrissur</option>
                        <option value="Palakkad">Palakkad</option>
                        <option value="Malappuram">Malappuram</option>
                        <option value="Kozhikode">Kozhikode</option>
                        <option value="Wayanad">Wayanad</option>
                        <option value="Kannur">Kannur</option>
                        <option value="Kasaragod">Kasaragod</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="mobile">
                        <i class="fas fa-phone"></i> Mobile Number
                    </label>
                    <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" placeholder="Enter 10-digit mobile number" required>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn-primary" id="submit" name="submit">
                        <i class="fas fa-paper-plane"></i> Submit Request
                    </button>
                    <button type="button" class="btn-secondary" onclick="window.location.href='user-dashboard.php'">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Add loading state on form submission
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submit');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>