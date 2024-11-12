<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" type="x-icon" href="imggg.png">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./../main/contact/contact.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Spline Viewer for background -->
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/aDzPBClA4yfpwnV4/scene.splinecode"></spline-viewer>
    </div>

    <!-- Logo Container --> 
    <div class="logo-container">
        <img src="imggg.png" alt="logo" class="logo" style="margin-right: 920px; margin-top:150px">
    </div>

    <!-- Button container -->
    <div class="button-container">
    <button class="cool-button" onclick="window.location.href='../sign/signup.php'">Sign Up</button>
    <button class="cool-button" onclick="window.location.href='../sign/signin.php'">Sign In</button>
</div>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
    <!--function that remove the spline logo-->
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
