<script>
const socket = io("http://localhost:3000"); // Connect to the Socket.IO server
let timer;
let isBreak = false;
let timeLeft = 1500; // 25 minutes
const timerDisplay = document.getElementById('timer');

function updateTimerDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

function startTimer() {
    timer = setInterval(() => {
        if (timeLeft > 0) {
            timeLeft--;
            // Send updated timer state to the server
            socket.emit("update timer", { timeLeft, isBreak, isRunning: true });
            updateTimerDisplay();
        } else {
            clearInterval(timer);
            isBreak = !isBreak;
            timeLeft = isBreak ? 300 : 1500; // 5 min break or 25 min work
            updateTimerDisplay();
            startTimer(); // Automatically start the next timer
        }
    }, 1000);
}

document.getElementById('start').onclick = function() {
    clearInterval(timer);
    timeLeft = 1500; // Reset to 25 minutes
    updateTimerDisplay();
    startTimer();
    // Also emit initial timer state
    socket.emit("update timer", { timeLeft, isBreak, isRunning: true });
};

document.getElementById('stop').onclick = function() {
    clearInterval(timer); // Stop the timer
    socket.emit("update timer", { timeLeft, isBreak, isRunning: false });
};

document.getElementById('reset').onclick = function() {
    clearInterval(timer); // Stop the timer
    timeLeft = 1500; // Reset to 25 minutes
    isBreak = false;
    updateTimerDisplay(); // Update display
    socket.emit("update timer", { timeLeft, isBreak, isRunning: false });
};

// Listen for timer updates from the server
socket.on("timer update", (newTimerState) => {
    timeLeft = newTimerState.timeLeft;
    isBreak = newTimerState.isBreak;
    updateTimerDisplay();
});

// Initialize the display with server data
socket.on("initialize", (data) => {
    // Update tasks and timer state if needed
    tasks = data.tasks;
    timeLeft = data.timerState.timeLeft;
    isBreak = data.timerState.isBreak;
    updateTimerDisplay();
});

updateTimerDisplay(); // Initial display update
</script>