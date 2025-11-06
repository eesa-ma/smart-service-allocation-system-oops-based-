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
                        <input 
                            type="tel" 
                            id="tech-phone" 
                            name="tech-phone" 
                            placeholder="10-digit mobile number"
                            required>
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
                    <button type="button" class="btn btn-back" onclick="history.back()">
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
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                // Don't prevent default - let form submit normally
                const textSpan = submitBtn.querySelector('span:first-of-type');
                const spinner = submitBtn.querySelector('.loading-spinner');
                
                if (textSpan) textSpan.style.display = 'none';
                if (spinner) spinner.style.display = 'inline-block';
                submitBtn.disabled = true;
            });
        }
    </script>
</body>
</html>