<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
    <div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/O4wdVneKYyKKbJbX/scene.splinecode"></spline-viewer>
    </div>
    <style>
        .error-messages, .success-message {
            font-size: 1rem;
            margin-top: 20px;
            display: none; /* Default hidden */
        }

        .error-messages {
            color: red;
        }

        .success-message {
            color: green;
        }

        button {
            background: linear-gradient(135deg, #0066ff, #33ccff); 
            color: #fff; 
            border: none;
            border-radius: 25px; 
            padding: 10px 20px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
            outline: none;
        }

        button:hover {
            background: linear-gradient(135deg, #33ccff, #0066ff); 
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); 
        }

        button:active {
            transform: scale(0.98);
        }

    </style>
</head>
<body>
    <div class="container">
        <form id="reset-password-form" action="reset-password-process.php" method="post">
            <h1>Reset Your Password</h1>
            <input type="text" placeholder="Enter your email address" name="email" id="email">
            <button type="submit">Reset Password</button>
            <div id="error-messages" class="error-messages">
            <!-- Show error message if any -->
        </div>

        </form>

        
        <div id="success-message" class="success-message">
            <!-- Show success message if email was sent -->
        </div>
    </div>
</body>
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
<script>
    window.onload = function() {
        const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
        if (shadowRoot) {
            const logo = shadowRoot.querySelector('#logo');
            if (logo) logo.remove();
        }

        // Email validation logic
        const form = document.getElementById('reset-password-form');
        const emailInput = document.getElementById('email');
        const errorMessages = document.getElementById('error-messages');

        form.addEventListener('submit', function(event) {
            const emailValue = emailInput.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Reset error display state
            errorMessages.style.display = 'none';
            errorMessages.textContent = '';

            if (emailValue === '') {
                event.preventDefault(); // Prevent form submission
                errorMessages.style.display = 'block'; // Show error message
                errorMessages.textContent = 'Please enter an email address.';
            } else if (!emailPattern.test(emailValue)) {
                event.preventDefault(); // Prevent form submission
                errorMessages.style.display = 'block'; // Show error message
                errorMessages.textContent = 'Please enter a valid email address.';
            }
        });
    };
</script>

