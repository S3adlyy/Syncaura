(function () {
    const app = document.querySelector(".app");
    const socket = io();
    let uname;

    const recordBtn = document.getElementById("audio");
    let mediaRecorder;
    let audioChunks = [];
    
    // Start/Stop recording
    recordBtn.addEventListener("click", async () => {
        if (!mediaRecorder || mediaRecorder.state === "inactive") {
            // Start recording
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            mediaRecorder = new MediaRecorder(stream);
            mediaRecorder.start();
    
            recordBtn.textContent = "⏹️ Stop Recording";
    
            mediaRecorder.ondataavailable = (event) => {
                audioChunks.push(event.data);
            };
    
            mediaRecorder.onstop = async () => {
                const audioBlob = new Blob(audioChunks, { type: "audio/webm" });
                audioChunks = []; // Reset chunks for future recordings
    
                // Send audio to the server
                const formData = new FormData();
                formData.append("audio", audioBlob);
    
                try {
                    const response = await fetch("/upload-audio", {
                        method: "POST",
                        body: formData,
                    });
    
                    if (!response.ok) {
                        throw new Error("Failed to upload audio");
                    }
    
                    const data = await response.json();
                    const audioFilePath = data.filePath;
    
                    // Emit the audio file path via WebSocket
                    socket.emit("voiceMessage", {
                        username: uname,
                        filePath: audioFilePath,
                    });
    
                    recordBtn.textContent = "🎙️ Record";
                } catch (error) {
                    console.error("Error uploading audio:", error);
                    recordBtn.textContent = "🎙️ Record";
                }
            };
        } else {
            // Stop recording
            mediaRecorder.stop();
        }
    });

    // Inject CSS Styles into the document head
    const style = document.createElement("style");
    style.innerHTML = `
        button {
            border: none;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Delete button */
        button.delete {
            background-color: #ff4d4d;
            color: white;
        }

        button.delete:hover {
            background-color: #e60000;
            transform: scale(1.1);
        }

        /* Modify button */
        button.modify {
            background-color: #4caf50;
            color: white;
        }

        button.modify:hover {
            background-color: #3e8e41;
            transform: scale(1.1);
        }
        
                
        
    `;
    document.head.appendChild(style);

    // Handle user joining the chat
    document.querySelector(".join-screen #join-user").addEventListener("click", function () {
        let username = document.querySelector(".join-screen #username").value.trim();
        let chatroom = document.querySelector(".join-screen #chatroom").value.trim();
    
        // Validation rules
        const roomNameRegex = /^[a-zA-Z0-9 ]{1,20}$/; // Alphanumeric and spaces, max 20 characters
        const usernameRegex = /^[a-zA-Z0-9_]{1,20}$/; // Alphanumeric and underscores, max 20 characters
    
        if (!chatroom) {
            alert("Chatroom name is required!");
            return;
        }
        if (!username) {
            alert("Username is required!");
            return;
        }
        if (!roomNameRegex.test(chatroom)) {
            alert("Chatroom name must be alphanumeric, no special symbols, and up to 20 characters.");
            return;
        }
        if (!usernameRegex.test(username)) {
            alert("Username must be alphanumeric (letters, numbers, underscores) and up to 20 characters.");
            return;
        }
    
        // If validation passes, emit the event
        socket.emit("newuser", { username, chatroom });
        uname = username;
    
        // Transition to the chat screen
        document.querySelector(".join-screen").classList.remove("active");
        document.querySelector(".chat-screen").classList.add("active");
    });

    // Handle sending a message
    app.querySelector(".chat-screen #send-message").addEventListener("click", function () {
        let message = app.querySelector(".chat-screen #message-input").value;
        if (message.length === 0) {
            return;
        }
        const messageData = {
            id: Date.now(),
            username: uname,
            text: message
        };
        renderMessage("my", messageData);
        socket.emit("chat", messageData);
        app.querySelector(".chat-screen #message-input").value = "";
    });

    // Handle user exit
    app.querySelector(".chat-screen #exit-chat").addEventListener("click", function () {
        socket.emit("exituser", uname);
        window.location.href = window.location.href;
    });

    // Listen for user updates (joins or leaves)
    socket.on("update", function (update) {
        renderMessage("update", update);
    });

    // Listen for new chat messages
    socket.on("chat", function (message) {
        renderMessage("other", message);
    });

    socket.on("imageMessage", (data) => {
        const { username, filePath } = data;
    
        // Create an image message object
        const messageData = {
            id: Date.now(),
            username: username,
            text: `<img src="${filePath}" alt="Image" style="max-width: 200px;">`,
        };
    
        // Render the message on the screen
        renderMessage(username === uname ? "my" : "other", messageData);
    });

    socket.on("voiceMessage", (data) => {
        const { username, filePath } = data;
    
        // Use the renderMessage function for consistency
        const messageData = {
            id: Date.now(),
            username: username,
            text: `<audio controls>
                      <source src="${filePath}" type="audio/webm">
                      Your browser does not support the audio element.
                   </audio>`
        };
    
        renderMessage(username === uname ? "my" : "other", messageData);
    });

    // Handle message deletion
    socket.on("message-deleted", function (id) {
        const messageElement = document.querySelector(`.message[data-id='${id}']`);
        if (messageElement) {
            messageElement.remove();
        }
    });

    // Handle message modification
    socket.on("message-modified", function (updatedMessage) {
        const messageElement = document.querySelector(`.message[data-id='${updatedMessage.id}']`);
        if (messageElement) {
            messageElement.querySelector(".text").textContent = updatedMessage.text;
        }
    });

    // Render messages on the screen
    function renderMessage(type, message) { 
        let messageContainer = app.querySelector(".chat-screen .messages");
    
        if (type === "my" || type === "other") {
            let el = document.createElement("div");
            el.setAttribute("class", `message ${type}-message`);
            el.setAttribute("data-id", message.id);
    
            // Check for GIF
            if (message.text.startsWith("GIF:")) {
                el.innerHTML = `
                    <div>
                        <div class="name">${type === "my" ? "You" : message.username}</div>
                        <div class="text">
                            <img src="${message.text.replace("GIF:", "")}" alt="GIF" style="max-width: 200px;">
                        </div>
                    </div>`;
            } 
            // Check for image
            else if (message.text.startsWith("<img")) {
                el.innerHTML = `
                    <div>
                        <div class="name">${type === "my" ? "You" : message.username}</div>
                        <div class="text">
                            ${message.text}
                        </div>
                    </div>`;
            } 
            // Normal text message
            else {
                el.innerHTML = `
                    <div>
                        <div class="name">${type === "my" ? "You" : message.username}</div>
                        <div class="text">${message.text}</div>
                    </div>`;
            }
    
            // Handle delete and modify buttons for the current user
            if (type === "my") {
                const deleteButton = document.createElement("button");
                deleteButton.textContent = "Delete";
                deleteButton.classList.add("delete");
                deleteButton.addEventListener("click", () => {
                    socket.emit("delete-message", message.id);
                });
                el.appendChild(deleteButton);
    
                const modifyButton = document.createElement("button");
                modifyButton.textContent = "Modify";
                modifyButton.classList.add("modify");
                modifyButton.addEventListener("click", () => {
                    const newMessageText = prompt("Edit your message:", message.text);
                    if (newMessageText !== null && newMessageText.trim() !== "") {
                        message.text = newMessageText;
                        socket.emit("modify-message", message);
                    }
                });
                el.appendChild(modifyButton);
            }
    
            messageContainer.appendChild(el);
        } else if (type === "update") {
            let el = document.createElement("div");
            el.setAttribute("class", "update");
            el.innerText = message;
            messageContainer.appendChild(el);
        }
    
        // Scroll to the bottom of the message container
        messageContainer.scrollTop = messageContainer.scrollHeight - messageContainer.clientHeight;
    }
    

    // GIF Search Functionality
    const API_KEY = "srhoeza0eIgGydSh2TGJYUz5JEUZtmzn";
    const searchInput = document.getElementById("search-input");
    const searchBtn = document.getElementById("search-btn");
    const gifResults = document.getElementById("gif-results");

    searchBtn.addEventListener("click", () => {
        const query = searchInput.value.trim();
        if (!query) return;

        fetch(`https://api.giphy.com/v1/gifs/search?api_key=${API_KEY}&q=${query}&limit=10`)
            .then(response => response.json())
            .then(data => {
                gifResults.innerHTML = "";
                data.data.forEach(gif => {
                    const img = document.createElement("img");
                    img.src = gif.images.fixed_height.url;
                    img.alt = gif.title;
                    img.style.cursor = "pointer";
                    img.addEventListener("click", () => selectGIF(gif.images.fixed_height.url));
                    gifResults.appendChild(img);
                });
            })
            .catch(error => console.error("Error fetching GIFs:", error));
    });

    function selectGIF(url) {
        const messageData = {
            id: Date.now(),
            username: uname,
            text: `GIF:${url}`
        };
        renderMessage("my", messageData);
        socket.emit("chat", messageData);
        gifResults.innerHTML = "";
        searchInput.value = "";
    }
    // Handle image upload
const imageUploadInput = document.getElementById("image-upload");

imageUploadInput.addEventListener("change", async (event) => {
    const file = event.target.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append("image", file);

    try {
        const response = await fetch("/upload-image", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error("Failed to upload image");
        }

        const data = await response.json();
        const imagePath = data.filePath;

        // Emit the image path via WebSocket
        socket.emit("imageMessage", {
            username: uname,
            filePath: imagePath,
        });

    } catch (error) {
        console.error("Error uploading image:", error);
    }
});


})();
