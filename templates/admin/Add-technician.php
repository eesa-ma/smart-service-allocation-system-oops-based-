<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Technician - Admin Panel</title>
    <link rel="stylesheet" href="css/Add-technician.css?v=3.2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-user-cog header-icon"></i>
                <h1>Register Technician</h1>
                <p class="header-subtitle">Add a new technician to the system</p>
            </div>

            <!-- Removed novalidate so browser will enforce required/pattern/email checks -->
            <form action="../../src/Controllers/AdminController.php" method="POST" class="technician-form" id="techForm">
                <input type="hidden" name="action" value="addtechnician">
                <input type="hidden" name="submit" value="1">

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="tech-name">
                            <i class="fas fa-user"></i>
                            Technician Name
                        </label>
                        <input 
                            type="text" 
                            id="tech-name" 
                            name="tech-name" 
                            placeholder="Enter full name"
                            required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="tech-skill">
                            <i class="fas fa-tools"></i>
                            Skills <span class="help-text">(Hold Ctrl/Cmd to select multiple)</span>
                        </label>
                        <select name="tech-skill[]" id="tech-skill" multiple size="4" required>
                            <option value="electronics repair">Electronics Repair</option>
                            <option value="device installation & setup">Device Installation & Setup</option>
                            <option value="technical troubleshooting">Technical Troubleshooting</option>
                        </select>
                    </div>
                </div>

                <div class="location-section">
                    <h3 class="section-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Location Details
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="house">House/Apartment</label>
                            <input 
                                type="text" 
                                id="house" 
                                name="house" 
                                placeholder="House no. and name"
                                required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="street">Street</label>
                            <input 
                                type="text" 
                                id="street" 
                                name="street" 
                                placeholder="Street name"
                                required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input 
                                type="text" 
                                id="city" 
                                name="city" 
                                placeholder="City"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="pincode">Postal Code</label>
                            <input 
                                type="number" 
                                id="pincode" 
                                name="pincode" 
                                placeholder="Postal code"
                                required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tech-phone">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </label>
                        <!-- pattern, inputmode and maxlength to help enforce 10-digit numeric input on client -->
                        <input 
                            type="tel" 
                            id="tech-phone" 
                            name="tech-phone" 
                            placeholder="10-digit mobile number"
                            pattern="\d{10}"
                            inputmode="numeric"
                            maxlength="10"
                            required
                            title="Enter a 10-digit phone number (digits only)">
                    </div>
                    <div class="form-group">
                        <label for="tech-mail">
                            <i class="fas fa-envelope"></i>
                            Email
                        </label>
                        <input 
                            type="email" 
                            id="tech-mail" 
                            name="tech-mail" 
                            placeholder="email@example.com"
                            required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="technician-password">
                            <i class="fas fa-lock"></i>
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="technician-password" 
                            name="technician-password" 
                            placeholder="Create password"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">
                            <i class="fas fa-lock"></i>
                            Confirm Password
                        </label>
                        <input 
                            type="password" 
                            id="confirm-password" 
                            name="confirm-password" 
                            placeholder="Re-enter password"
                            required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-back" onclick="window.location.href='admin-dashboard.php'">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </button>
                    <button type="submit" name="submit" class="btn btn-submit" id="submitBtn">
                        <i class="fas fa-user-plus"></i>
                        <span>Create Account</span>
                        <span class="loading-spinner" style="display: none;">
                            <i class="fas fa-circle-notch fa-spin"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('techForm');
        const submitBtn = document.getElementById('submitBtn');

        function showSpinner() {
            const textSpan = submitBtn.querySelector('span:first-of-type');
            const spinner = submitBtn.querySelector('.loading-spinner');
            if (textSpan) textSpan.style.display = 'none';
            if (spinner) spinner.style.display = 'inline-block';
            submitBtn.disabled = true;
        }

        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                // First let the browser validate required/email/pattern/etc.
                if (!form.checkValidity()) {
                    // Prevent submission and show native validation messages
                    e.preventDefault();
                    form.reportValidity(); // shows messages in modern browsers
                    return;
                }

                // Custom validation: phone must be exactly 10 digits
                const phone = document.getElementById('tech-phone').value.trim();
                const phoneRe = /^\d{10}$/;
                if (!phoneRe.test(phone)) {
                    e.preventDefault();
                    alert('Please enter a valid 10-digit phone number (digits only).');
                    document.getElementById('tech-phone').focus();
                    return;
                }

                // Custom validation: password confirmation
                const pass = document.getElementById('technician-password').value;
                const confirm = document.getElementById('confirm-password').value;
                if (pass !== confirm) {
                    e.preventDefault();
                    alert('Passwords do not match.');
                    document.getElementById('confirm-password').focus();
                    return;
                }

                // All checks passed -> show spinner and allow form to submit
                showSpinner();
                // allow normal submit to continue
            });
        }
    </script>
</body>
</html>