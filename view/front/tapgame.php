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
            align-items: center;
            padding: 10px;
            background: rgba(255, 255, 255, 0.7); 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .timer {
            font-size: 24px;
            margin-bottom: 10px;
            color: #fff;
        }

        .score {
            font-size: 20px;
            color: #ffec03;
            margin-bottom: 15px;
        }

        .symbol {
            position: absolute;
            font-size: 40px;
            cursor: pointer;
            transition: transform 0.2s ease;
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
    </style>
</head>
<body>
    <div class="game-container">
        <div class="timer">Time Left: <span id="time">30</span>s</div>
        <div class="score">Score: <span id="score">0</span></div>
        <button class="return-btn" onclick="returnToTasks()">Return to Tasks</button>
    </div>

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

        // Create a new symbol
        function createSymbol() {
            const symbol = document.createElement('div');
            symbol.classList.add('symbol');
            symbol.textContent = symbols[Math.floor(Math.random() * symbols.length)];

            // Set random position
            const x = Math.random() * (gameContainer.clientWidth - 40);
            const y = Math.random() * (gameContainer.clientHeight - 40);
            symbol.style.left = `${x}px`;
            symbol.style.top = `${y}px`;

            // Add event listener for clicking the symbol
            symbol.addEventListener('click', () => {
                score += 1;
                scoreElement.textContent = score;
                symbol.remove(); // Remove clicked symbol
                createSymbol(); // Add another symbol
            });

            // Animate the symbol to move faster
            animateSymbol(symbol);

            gameContainer.appendChild(symbol);

            // Remove the symbol after a few seconds
            setTimeout(() => {
                if (symbol.parentElement) {
                    symbol.remove();
                    createSymbol();
                }
            }, 3000); // Symbol disappears after 3 seconds if not clicked
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
            for (let i = 0; i < 3; i++) {
                createSymbol();
            }
        }

        // End the game
        function endGame() {
            alert(`Time's up! Your score is: ${score}`);
            gameContainer.innerHTML = '<h2>Game Over</h2><p>Reload the page to play again!</p>';
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
