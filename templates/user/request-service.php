<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f3f3e0;
            background-image: url('/smart-sevice-allocation-system/public/images/all.png'); 
            background-size: cover;
            background-position: left;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #333333;
            color:white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: darkred;
        }
        .backbutton {
            width: 100%;
            padding: 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px; 
}

.backbutton:hover {
    background: darkred;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Service Request Form</h2>
        <form action="../../src/Controllers/UserController.php" method="POST" id="serviceForm">
            <input type="hidden" name="action" value="request_service">
            <label for="serviceType">Type of Service:</label>
            <select id="serviceType" name="serviceType" required>
                <option value="">Select</option>
                <option value="electronics-repair">Electronics Repair</option>
                <option value="device-installation">Device Installation & Setup</option>
                <option value="technical-troubleshooting">Technical Troubleshooting</option>
            </select>
            
            <label for="description">Service Description:</label>
            <textarea id="description" name="description" required></textarea>
            
            <label for="location">District:</label>
            <select id="location" name="location" required>
                <option value="">Select District</option>
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
            <label for="mobile">Mobile Number:</label>
            <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" placeholder="Enter 10-digit mobile number" required>
            <button type="submit" id="submit" name="submit">Submit Request</button>
            <button onclick="history.back()" class="backbutton" name="backbutton" >
        back
        </button>        
        </form>
    </div>
</body>
</html>
