window.onload = function() {
    const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
    if (shadowRoot) {
        const logo = shadowRoot.querySelector('#logo');
        if (logo) logo.remove();
    }
}
function toggleFullscreen() {
if (!document.fullscreenElement) {
document.documentElement.requestFullscreen();
} else if (document.exitFullscreen) {
document.exitFullscreen();
}
}