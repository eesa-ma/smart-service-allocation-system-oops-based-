    // Form validation and password matching
    const form = document.getElementById('createForm');
    const password = document.getElementById('user-password');
    const confirmPassword = document.getElementById('confirm-password');
    const matchHint = document.getElementById('matchHint');
    const submitBtn = document.getElementById('submit');

    // Check password match in real-time
    function checkPasswordMatch() {
      if (confirmPassword.value === '') {
        matchHint.textContent = '';
        matchHint.style.color = '';
        return;
      }
      
      if (password.value === confirmPassword.value) {
        matchHint.textContent = '✓ Passwords match';
        matchHint.style.color = '#22c55e';
      } else {
        matchHint.textContent = '✗ Passwords do not match';
        matchHint.style.color = '#ef4444';
      }
    }

    password.addEventListener('input', checkPasswordMatch);
    confirmPassword.addEventListener('input', checkPasswordMatch);

    // Toggle password visibility
    document.querySelectorAll('.toggle-pass').forEach(button => {
      button.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const targetInput = document.getElementById(targetId);
        
        if (targetInput.type === 'password') {
          targetInput.type = 'text';
          this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
          this.setAttribute('aria-label', 'Hide password');
        } else {
          targetInput.type = 'password';
          this.innerHTML = '<i class="fa-solid fa-eye"></i>';
          this.setAttribute('aria-label', 'Show password');
        }
      });
    });

    // Form submission validation
    form.addEventListener('submit', function(e) {
      // Validate all required fields are filled
      let emptyFields = [];
      const requiredFields = [
        { id: 'user-name', label: 'Name' },
        { id: 'user-email', label: 'Email' },
        { id: 'user-phone', label: 'Phone' },
        { id: 'pincode', label: 'Postal code' },
        { id: 'house', label: 'House' },
        { id: 'street', label: 'Street' },
        { id: 'city', label: 'City' },
        { id: 'user-password', label: 'Password' },
        { id: 'confirm-password', label: 'Confirm Password' }
      ];

      requiredFields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value.trim()) {
          emptyFields.push(field.label);
        }
      });

      if (emptyFields.length > 0) {
        e.preventDefault();
        alert('Please fill in all required fields:\n- ' + emptyFields.join('\n- '));
        return false;
      }

      // Check if passwords match
      if (password.value !== confirmPassword.value) {
        e.preventDefault();
        alert('Passwords do not match. Please make sure both passwords are the same.');
        confirmPassword.focus();
        return false;
      }

      // Check password length
      if (password.value.length < 6) {
        e.preventDefault();
        alert('Password must be at least 6 characters long.');
        password.focus();
        return false;
      }

      // Validate phone number
      const phone = document.getElementById('user-phone').value;
      if (!/^[0-9]{10}$/.test(phone)) {
        e.preventDefault();
        alert('Please enter a valid 10-digit phone number.');
        document.getElementById('user-phone').focus();
        return false;
      }

      // Validate email
      const email = document.getElementById('user-email').value;
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address.');
        document.getElementById('user-email').focus();
        return false;
      }

      // Validate postal code (should be numeric)
      const pincode = document.getElementById('pincode').value;
      if (!pincode || pincode.length < 6) {
        e.preventDefault();
        alert('Please enter a valid postal code (at least 6 digits).');
        document.getElementById('pincode').focus();
        return false;
      }
    });

    // Add visual feedback for required fields
    const requiredInputs = form.querySelectorAll('input[required]');
    requiredInputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.value.trim() === '') {
          this.style.borderColor = '#ef4444';
        } else {
          this.style.borderColor = '';
        }
      });

      input.addEventListener('input', function() {
        if (this.value.trim() !== '') {
          this.style.borderColor = '';
        }
      });
    });