<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="spline-viewer">
    <spline-viewer url="https://prod.spline.design/xe1NYzF0G4mjrdh6/scene.splinecode"></spline-viewer>
    </div>
    <div class="contact">
        <form class="contact-left" action="https://api.web3forms.com/submit" method="POST">
        <input type="hidden" name="access_key" value="5af132b5-8248-4d4d-9183-be0b92687b72">
            <div class="contact-left-title">
                <h2>Get in touch</h2>
                <hr>
            </div>
            <input type="text" name="name" placeholder="Your name" class="contact-inputs" required>
            <input type="email" name="email" placeholder="Your email" class="contact-inputs" required>
            <textarea name="message" placeholder="Your message" class="contact-inputs" required></textarea>
            <button type="submit">submit<img src="./assets/arrow_icon.png" alt="send"></button>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.37/build/spline-viewer.js"></script>
    <script>
        const splineViewer = document.querySelector('spline-viewer');
        document.addEventListener('mousemove', (event) => {
            const { innerWidth, innerHeight } = window;
            const x = (event.clientX / innerWidth) * 2 - 1;
            const y = -(event.clientY / innerHeight) * 2 + 1;
            const rotationSpeed = 1;
            splineViewer.camera.rotation.x = y * rotationSpeed;
            splineViewer.camera.rotation.y = x * rotationSpeed;
        });

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


