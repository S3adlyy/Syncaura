<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Platform</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../home/home.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/6ZtcG0S4vuc4ENuz/scene.splinecode"></spline-viewer>
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

        // Handle Create Project button click
        const createProjectBtn = document.getElementById('createProjectBtn');
        createProjectBtn.addEventListener('click', () => {
            alert('Create Project button clicked!');
            // Add your create project functionality here
        });
    </script>
</body>
</html>
