     setTimeout(function() {
            window.location.href = "http://localhost:5000"; 
        }, 10000); 
        window.onload = function() {
            const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
            if (shadowRoot) {
                const logo = shadowRoot.querySelector('#logo');
                if (logo) logo.remove();
            }
        }