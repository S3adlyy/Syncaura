<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catch the Symbols</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1e1e2f;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .spline-viewer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1;
        }

        .game-container {
            position: relative;
            width: 500px;
            height: 500px;
            border-radius: 15px;
            z-index: 2;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items:center;
            padding: 10px;
            background: rgba(255, 255, 255, 0.7); 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .timer {
            font-size: 18px;
            margin-bottom: 10px;
            color: #CB1515;
            font-weight: bold;
        }

        .score {
            font-size: 20px;
            color: #ffec03;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .symbol {
            position: absolute;
            font-size: 40px;
            cursor: pointer;
        }

        .return-btn {
            position: absolute;
            bottom: 15px;
            font-size: 16px;
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 3;
        }

        .return-btn:hover {
            background-color: #c0392b;
        }

    .symbol {
        position: absolute;
        font-size: 40px;
        cursor: pointer;
        animation: slide linear infinite;
        transition: all 0.5s ease-in-out; /* Smooth movement over 0.5 seconds */
    }

    </style>
</head>
<body>
    <div class="game-container">
        <div align="right"class="timer">Time Left: <span id="time">30</span>s</div>
        <div class="score">Score: <span id="score">0</span></div>
    </div>
    <button class="return-btn" onclick="returnToTasks()">Return to Tasks</button>

    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/NlYMwsWFwYQczsL5/scene.splinecode"></spline-viewer>
    </div>

    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
    <script>
        // DOM Elements
        const gameContainer = document.querySelector('.game-container');
        const timerElement = document.getElementById('time');
        const scoreElement = document.getElementById('score');

        // Game Variables
        let score = 0;
        let timeLeft = 30;
        let gameInterval;

        // Significant Symbols (related to productivity, focus, etc.)
        const symbols = ['📚', '🕒', '✅', '💡', '🔥', '🏆', '🎯', '📈', '💻', '🌟'];
        //trajectoire hyperbolique
        function animateSymbol(symbol) {
            let t = 0; // Time variable to control the position along the curve
            const speed = 0.02; // Controls how fast the symbol moves along the arc
            const centerX = gameContainer.clientWidth / 2;  // Center of the container (x-axis)
            const centerY = gameContainer.clientHeight / 2; // Center of the container (y-axis)
            const radius = Math.random() * 100 + 50; // Random radius for each symbol (size of the curve)
            const phaseShift = Math.random() * Math.PI; // Random phase shift for variation in movement

            // Set the initial position of the symbol offscreen or starting at the bottom (below center)
            const initialX = centerX + radius * Math.cos(t + phaseShift);
            const initialY = centerY + radius * Math.sin(t + phaseShift); // Starting below the center

            symbol.style.left = `${initialX}px`;
            symbol.style.top = `${initialY}px`;

            // Add the symbol to the game container
            gameContainer.appendChild(symbol);

            // Move the symbol along the curved path
            const moveInterval = setInterval(() => {
                t += speed; // Increment time to move along the arc

                // Calculate the new position based on the circular motion
                const x = centerX + radius * Math.cos(t + phaseShift); // X coordinate of the curved path
                const y = centerY + radius * Math.sin(t + phaseShift); // Y coordinate of the curved path

                // Apply the updated position
                symbol.style.transition = 'left 0.1s ease, top 0.1s ease'; // Smooth transition for each move
                symbol.style.left = `${x}px`;
                symbol.style.top = `${y}px`;

                // Remove the symbol after completing the half-circle
                if (t > Math.PI) {  // Stop after half-circle (180 degrees)
                    clearInterval(moveInterval);
                    if (symbol.parentElement) {
                        symbol.remove(); // Remove the symbol after completing its path
                        createSymbol(); // Create a new symbol after the previous one finishes its movement
                    }
                }
            }, 20); // Update position every 20ms for smoothness
        }




        // Create a new symbol
        function createSymbol() {
            const symbol = document.createElement('div');
            symbol.classList.add('symbol');
            symbol.textContent = symbols[Math.floor(Math.random() * symbols.length)];

            // Randomize starting position
            const xStart = Math.random() * (gameContainer.clientWidth - 40);
            const yStart = Math.random() * (gameContainer.clientHeight - 40);

            symbol.style.left = `${xStart}px`;
            symbol.style.top = `${yStart}px`;

            // Add click functionality
            symbol.addEventListener('click', () => {
                score += 1;
                scoreElement.textContent = score;
                symbol.remove(); // Remove clicked symbol
                createSymbol(); // Add another symbol
            });

            // Animate the symbol with hyperbolic movement
            animateSymbol(symbol);

            gameContainer.appendChild(symbol);

            // Remove the symbol after a timeout
            setTimeout(() => {
                if (symbol.parentElement) {
                    symbol.remove();
                    createSymbol();
                }
            }, 5000); // Symbol disappears after 5 seconds if not clicked
        }


        // Animate symbol movement
        function animateSymbol(symbol) {
            const moveInterval = setInterval(() => {
                const x = Math.random() * (gameContainer.clientWidth - 40);
                const y = Math.random() * (gameContainer.clientHeight - 40);
                symbol.style.left = `${x}px`;
                symbol.style.top = `${y}px`;
            }, 2000); // Symbol moves every 600ms
        }

        // Start the game
        function startGame() {
            gameInterval = setInterval(() => {
                timeLeft -= 1;
                timerElement.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(gameInterval);
                    endGame();
                }
            }, 1000);

            // Create multiple symbols at the start
            for (let i = 0; i < 5; i++) {
                createSymbol();
            }
        }

        // End the game
        function endGame() {
            alert(`Time's up! Your score is: ${score}`);
            gameContainer.innerHTML = '<p style="font-weight:bold;">Reload the page to play again!!!</p>';
        }

        // Return to Tasks
        function returnToTasks() {
            const urlParams = new URLSearchParams(window.location.search);
            const planName = urlParams.get('planName');
            window.location.href = `todotasks.php?planName=${planName}`;
        }

        // Initialize the game
        window.onload = startGame;
    </script>
</body>
</html>
