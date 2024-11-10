<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/YnhSKl1mxDg5nBe0/scene.splinecode"></spline-viewer>
    </div>
    <div class="container">
        <form action="" method="post">
            <h1>Login Form</h1>
            <input type="text" placeholder="Put your name" name="name" id="name" required>
            <input type="password" placeholder="Password" name="pass" id="pass" required>
            <button type="button" onclick="window.location.href='../main/loadng.php'">Login</button>
            <p>Not a member? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
    <script>
        window.onload = function() {
            const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
            if (shadowRoot) {
                const logo = shadowRoot.querySelector('#logo');
                if (logo) logo.remove();
            }
        }
    </script>
</body>
</html>
