<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="imgggg.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-color: black;
            color: white;
        }
        .spline-viewer {
            width: 100%;
            height: 50%;
        }
        .playlist {
            width: 100%;
            max-width: 600px; /* Set a max width for better control */
            height: 152px;
            margin-bottom: 20px; /* Space between playlist and timer */
            border-radius: 12px; /* Rounded corners */
            overflow: hidden; /* Hide overflow for rounded corners */
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.2); /* Add shadow */
        }
        .timer {
            text-align: center;
            font-size: 48px;
            margin: 20px 0;
        }
        .buttons {
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
            border: none;
            background-color: #444;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s; /* Smooth transition */
        }
        button:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="playlist">
        <iframe src="https://open.spotify.com/embed/playlist/2VV2tifRGiXCxo8PntCQPx?utm_source=generator&theme=0" 
                width="100%" height="100%" frameBorder="0" allowfullscreen="" 
                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                loading="lazy"></iframe>
    </div>
    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/0mot9ey9UxvXqFcO/scene.splinecode"></spline-viewer>
    </div>
    <div class="timer" id="timer">25:00</div>
    <div class="buttons">
        <button id="start">Start</button>
        <button id="stop">Stop</button>
        <button id="reset">Reset</button>
    </div>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
    <script>

        window.onload = function() {
            var shadowRoot = document.querySelector('spline-viewer').shadowRoot;
            shadowRoot.querySelector('#logo').remove();
        }

        let timer;
        let isBreak = false;
        let timeLeft = 1500; // 25 minutes in seconds
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
        };

        document.getElementById('stop').onclick = function() {
            clearInterval(timer); // Stop the timer
        };

        document.getElementById('reset').onclick = function() {
            clearInterval(timer); // Stop the timer
            timeLeft = 1500; // Reset to 25 minutes
            isBreak = false;
            updateTimerDisplay(); // Update display
        };

        updateTimerDisplay(); // Initial display update
    </script>
</body>
</html>
