const socket = io();
const canvas = document.getElementById('whiteboard');
const ctx = canvas.getContext('2d');

let drawing = false;
let lastX = 0;
let lastY = 0;
let currentColor = '#000000';
let brushSize = 2;
let brushType = 'round';
let erasing = false;


canvas.addEventListener('mousedown', (e) => {
    drawing = true;
    lastX = e.offsetX;
    lastY = e.offsetY;
});


canvas.addEventListener('mouseup', () => {
    drawing = false;
});


canvas.addEventListener('mousemove', (e) => {
    if (!drawing) return;

    const x = e.offsetX;
    const y = e.offsetY;

    if (erasing) {
        
        const eraseSize = brushSize * 5; 
        ctx.clearRect(x - eraseSize / 2, y - eraseSize / 2, eraseSize, eraseSize);
        socket.emit("draw", { lastX: x, lastY: y, x, y, erase: true, brushSize: eraseSize });
    } else {
        drawLine(lastX, lastY, x, y);
        socket.emit("draw", { lastX, lastY, x, y, erase: false, color: currentColor, brushSize, brushType });
    }

    lastX = x;
    lastY = y;
});


function drawLine(x1, y1, x2, y2) {
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.strokeStyle = currentColor;
    ctx.lineWidth = brushSize;
    ctx.lineCap = brushType;
    ctx.stroke();
}

socket.on('draw', (data) => {
    if (data.erase) {
        const eraseSize = data.brushSize * 5; 
        ctx.clearRect(data.x - eraseSize / 2, data.y - eraseSize / 2, eraseSize, eraseSize);
    } else {
        drawLine(data.lastX, data.lastY, data.x, data.y);
    }
});

document.getElementById('clear').addEventListener('click', () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    socket.emit('clear');
});

// Erase mode toggle
document.getElementById('erase').addEventListener('click', () => {
    erasing = !erasing;
    document.getElementById('erase').textContent = erasing ? 'Draw' : 'Erase';
});

document.getElementById('color-picker').addEventListener('input', (e) => {
    currentColor = e.target.value;
    socket.emit("updateSettings", { color: currentColor });
});
document.getElementById('brush-size').addEventListener('input', (e) => {
    brushSize = e.target.value;
    socket.emit("updateSettings", { brushSize });
});

document.getElementById('brush-type').addEventListener('change', (e) => {
    brushType = e.target.value;
    socket.emit("updateSettings", { brushType });
});

socket.on('clear', () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
});

// Listen for settings update (color, size, type)
socket.on('updateSettings', (settings) => {
    if (settings.color) currentColor = settings.color;
    if (settings.brushSize) brushSize = settings.brushSize;
    if (settings.brushType) brushType = settings.brushType;
});
