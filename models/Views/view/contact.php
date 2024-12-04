<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Interface</title>
    <style>
        html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
    overflow: hidden;
    display: flex; /* Use flexbox for centering */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    }

    .spline-viewer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 1;
    }
        .container {
            position: relative;
            width: 400px;
            padding: 20px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .input-section {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #messageInput {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
            outline: none;
        }
        #sendButton {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #3a7bd5;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #sendButton:hover {
            background-color: #2874a6;
        }
        .message-display {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            max-height: 200px;
            overflow-y: auto;
        }
        .message {
            padding: 5px 10px;
            margin: 5px 0;
            background-color: rgba(58, 123, 213, 0.1);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="input-section">
            <input type="text" id="messageInput" placeholder="Type your message here...">
            <button id="sendButton">Send</button>
        </div>
        <div class="message-display" id="messageDisplay">
            <!-- Messages will be displayed here -->
        </div>
    </div>

    <script>
        const sendButton = document.getElementById('sendButton');
        const messageInput = document.getElementById('messageInput');
        const messageDisplay = document.getElementById('messageDisplay');

        sendButton.addEventListener('click', () => {
            const messageText = messageInput.value.trim();
            if (messageText) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.textContent = messageText;
                messageDisplay.appendChild(messageElement);
                messageInput.value = '';
            }
        });
    </script>
</body>
</html>
