const form = document.getElementById('techForm');
        const submitBtn = document.getElementById('submitBtn');

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
            });
        }