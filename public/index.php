<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Service Allocation System - Home</title>
    <link rel="stylesheet" href="css/index-new.css?v=2.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <header>
        <nav class="navbar">
            <div class="logo">
               <a href="#home">
                   <img src="images/logo.png" alt="Smart Service Logo">
               </a> 
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">Login <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="../templates/user/user-signin.php"><i class="fas fa-user"></i> User</a></li>
                        <li><a href="../templates/admin/admin-signin.php"><i class="fas fa-user-shield"></i> Admin</a></li>
                        <li><a href="../templates/technician/technician-signin.php"><i class="fas fa-wrench"></i> Technician</a></li>
                    </ul>
                </li>
            </ul>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Smart Service Solutions at Your Fingertips!</h1>
                <p>Easily request and track services, with skilled technicians assigned at your location.</p>
                <a href="../templates/user/user-signin.php" class="btn-hero">
                    <i class="fas fa-rocket"></i> Get Started
                </a>
            </div>
            <div class="hero-image">
                <img src="images/technician.png" alt="Professional technician">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="section-title">About Our System</h2>
            
            <div class="about-intro">
                <div class="about-text">
                    <p>Managing service requests efficiently is crucial for any service-based business. Our Smart Service Allocation System simplifies this process by seamlessly connecting customers with skilled technicians based on their location. Whether it's home maintenance, appliance repair, or technical support, our system ensures fast and reliable service with just a few clicks.</p>
                </div>
                <div class="about-image">
                    <img src="images/about-img.webp" alt="About our system">
                </div>
            </div>

            <h3 class="subsection-title">How It Works</h3>
            <div class="how-it-works">
                <div class="work-step">
                    <div class="step-number">1</div>
                    <h4>Submit Request</h4>
                    <p>Users submit a service request by entering their location and issue details</p>
                </div>
                <div class="work-step">
                    <div class="step-number">2</div>
                    <h4>Admin Review</h4>
                    <p>Admins review the requests and assign a suitable technician based on location and availability</p>
                </div>
                <div class="work-step">
                    <div class="step-number">3</div>
                    <h4>Assignment</h4>
                    <p>Technicians receive assignments and update their status upon task completion</p>
                </div>
                <div class="work-step">
                    <div class="step-number">4</div>
                    <h4>Track Status</h4>
                    <p>Users can track request status in real time</p>
                </div>
            </div>

            <h3 class="subsection-title">Key Features</h3>
            <div class="features">
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h4>Quick Service Requests</h4>
                    <p>Submit service requests easily through a simple interface</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>Location-based Assignments</h4>
                    <p>Technicians are assigned based on proximity for faster response</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-eye"></i>
                    <h4>Real-time Tracking</h4>
                    <p>Users can check whether their request has been assigned</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar-check"></i>
                    <h4>Availability Management</h4>
                    <p>Technicians can mark themselves as Available/Unavailable</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-image">
                        <img src="images/electronicrepair.png" alt="Electronics Repair">
                    </div>
                    <div class="service-content">
                        <h3>Electronics Repair</h3>
                        <p>Get expert repair services for TVs, laptops, smartphones, and home appliances like refrigerators and washing machines.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="images/deviceinstall.png" alt="Device Installation">
                    </div>
                    <div class="service-content">
                        <h3>Device Installation & Setup</h3>
                        <p>Need help installing a new smart TV, home theater, or kitchen appliance? Our technicians ensure a hassle-free setup.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="images/troubleshoot.png" alt="Technical Troubleshooting">
                    </div>
                    <div class="service-content">
                        <h3>Technical Troubleshooting</h3>
                        <p>Get support for software and hardware issues in your electronic devices, from slow performance to connectivity problems.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Having a problem?</h2>
            <p>We'll fix it today!</p>
            <a href="../templates/user/user-signin.php" class="btn-cta">
                <i class="fas fa-play-circle"></i> Get Started Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Smart Service Allocation System. All rights reserved.</p>
            <div class="footer-links">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navMenu = document.querySelector('.nav-menu');
        
        mobileMenuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    navMenu.classList.remove('active');
                }
            });
        });

        // Sticky header on scroll
        const header = document.querySelector('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Dropdown (Login) - click to toggle, close on outside click and Esc
        const dropdown = document.querySelector('.dropdown');
        const dropdownToggle = dropdown ? dropdown.querySelector('.dropdown-toggle') : null;

        if (dropdown && dropdownToggle) {
            dropdownToggle.addEventListener('click', (e) => {
                e.preventDefault();
                const isOpen = dropdown.classList.toggle('open');
                dropdownToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });

            // Close when clicking outside
            document.addEventListener('click', (e) => {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('open');
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Close with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    dropdown.classList.remove('open');
                    dropdownToggle.setAttribute('aria-expanded', 'false');
                    dropdownToggle.focus();
                }
            });
        }
    </script>
</body>
</html>