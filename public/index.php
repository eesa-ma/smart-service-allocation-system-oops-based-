<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>landingpage</title>
    <link rel="stylesheet" href="css/submit-button.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
               <a href="#home"><img src="images/logo.png" alt="logo" width="250px"></a> 
            </div>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about-section">About</a></li>
                <li><a href="#services">Service</a></li>
                <li class="dropdown">
                    <a href="#">Login ▼</a>
                    <ul class="dropdown-menu">
                    <li><a href="../templates/user/create-account.php">User</a></li>
                        <li><a href="../admin/admin-login.php">Admin</a></li>
                        <li><a href="../technician/technician_login.php">Technician</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
     <section id="home" class="hero">
        <div id="hero-text">
            <h1>Smart Service Solutions at Your Fingertips!</h1>
            <p>Easily request and track services, with skilled technicians assigned at your location.</p>
        </div>
        <div>
            <img src="images/technician.png" alt="technician">
        </div>
     </section>
    <section id="about-section">
        <h2>About Our System</h2>
        <div id="about">
            <p>Managing service requests efficiently is crucial for any service-based business. Our Smart Service Allocation System simplifies this process by seamlessly connecting customers with skilled technicians based on their location. Whether it's home maintenance, appliance repair, or technical support, our system ensures fast and reliable service with just a few clicks</p>
            <img src="images/about-img.webp" alt="">
        </div>
        <h3>How It Works</h3>
        <div id="works">
            <p>1️. Users submit a service request by entering their location and issue details</p>
            <p>2️. Admins review the requests and assign a suitable technician based on location and availabipty.</p>
            <p>3️. Technicians receive assignments and update their status upon task completion.</p>
            <p>4️. Users can track request status in real time.</p>
        </div>
        <h3>Key Features</h3>
        <div id="features">
            <p>✔ Quick Service Requests – Submit service requests easily through a simple interface.</p>
            <p>✔ Location-based Assignments – Technicians are assigned based on proximity for faster response.</p>
            <p>✔ Real-time Tracking – Users can check whether their request has been assigned.</p>
            <p>✔ Technician Availability Management – Technicians can mark themselves as Available/Unavailable.</p>
        </div>
    </section>

    <h2 class="servicename">Our Services</h2>
    <section id="services">
        <div >
            <div>
                <h3>Electronics Repair</h3>
                <p> Get expert repair services for TVs, laptops, smartphones, and home appliances like refrigerators and washing machines.</p>
            </div>
            <img src="images/electronicrepair.png" alt="technician">
        </div>

        <div >
            <div>
                <h3> Device Installation & Setup</h3>
                <p>Need help installing a new smart TV, home theater, or kitchen appliance? Our technicians ensure a hassle-free setup.</p>
            </div>
            <img src="images/deviceinstall.png" alt="technician">
        </div>

        <div >
            <div>
                <h3>Technical Troubleshooting</h3>
                <p>Get support for software and hardware issues in your electronic devices, from slow performance to connectivity problems.</p>
            </div>
            <img src="images/troubleshoot.png" alt="technician">
        </div>
    </section> 
    <section id="direct-user-login">
        <p>Having a problem?</p>
        <p>We'll fixed today!</p>
        <a href="../user/user-signin.php" id="submit"  >Get Started</a>
    </section>
     <footer>
        <p>&copy; 2025 Smart Service Allocation System</p>
    </footer>

</body>
</html>