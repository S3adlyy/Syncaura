(function () {
    const app = document.querySelector(".app");
    const socket = io();
    let uname;

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
        let username = document.querySelector(".join-screen #username").value;
        let chatroom = document.querySelector(".join-screen #chatroom").value;

        if (username.length === 0 || chatroom.length === 0) {
            alert("Username and chatroom are required!");
            return;
        }

        socket.emit("newuser", { username, chatroom });
        uname = username;

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

            if (message.text.startsWith("GIF:")) {
                el.innerHTML = `
                    <div>
                        <div class="name">${type === "my" ? "You" : message.username}</div>
                        <div class="text">
                            <img src="${message.text.replace("GIF:", "")}" alt="GIF" style="max-width: 200px;">
                        </div>
                    </div>`;
            } else {
                el.innerHTML = `
                    <div>
                        <div class="name">${type === "my" ? "You" : message.username}</div>
                        <div class="text">${message.text}</div>
                    </div>`;
            }

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
})();
