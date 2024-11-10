<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="x-icon" href="img.png">
</head>
<body>
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/YnhSKl1mxDg5nBe0/scene.splinecode"></spline-viewer>
    </div>
    <form action="config.php" method="post">
        <h1>Signup Form</h1>
        <input type="text" placeholder="Put your name" name="name" id="name">
        <input type="email" placeholder="Email" name="email" id="email">
        <input type="password" placeholder="Password" name="pass" id="pass">
        <input type="submit" name="send" id="send">
        <p>Already a member? <a href="signin.php" style="color: blue;">Sign In</a></p>
    </form>

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
