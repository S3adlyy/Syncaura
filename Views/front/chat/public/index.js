const usernameInput = document.getElementById("username");
        const resultText = document.querySelector("p[name='result']");
        const joinUserButton = document.getElementById("join-user");
        const joinScreen = document.querySelector(".join-screen");
        const chatScreen = document.querySelector(".chat-screen");
        const emojiBtn = document.getElementById("emoji-btn");
        const emojiPicker = document.getElementById("emoji-picker");
        const messageInput = document.getElementById("message-input");

    
        // Show feedback on username input
        usernameInput.addEventListener("input", () => {
            if (usernameInput.value.trim() !== "") {
                resultText.textContent = "correct";
                resultText.style.color = "green";
            } else {
                resultText.textContent = "";
                resultText.style.color = "initial";
            }
        });
    
        // Transition to chat screen when user joins
        joinUserButton.addEventListener("click", () => {
            if (usernameInput.value.trim() !== "") {
                joinScreen.classList.remove("active");  // Hide the join screen
                chatScreen.classList.add("active");     // Show the chat screen
                // Optionally, you can send the username to the server via Socket.IO
                const username = usernameInput.value.trim();
                socket.emit('user-joined', username); // Emit event when user joins
            }
        });
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


// Toggle emoji picker visibility when the emoji button is clicked
    emojiBtn.addEventListener("click", () => {
    if (emojiPicker.style.display === "block") {
        emojiPicker.style.display = "none";
    } else {
        emojiPicker.style.display = "block";
    }
});

// Add emoji to the message input when an emoji is clicked
    emojiPicker.addEventListener("click", (event) => {
    if (event.target.tagName === "SPAN") {
        const emoji = event.target.textContent;
        messageInput.value += emoji; // Append the emoji to the message input
        emojiPicker.style.display = "none"; // Optionally close the emoji picker
    }
});

// Hide emoji picker if clicked outside
    document.addEventListener("click", (event) => {
    if (!emojiPicker.contains(event.target) && event.target !== emojiBtn) {
        emojiPicker.style.display = "none";
    }
});