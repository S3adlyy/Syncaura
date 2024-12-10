const sendChatBtn = document.querySelector(".chat-input span");
const chatInput = document.querySelector(".chat-input textarea");
const chatbox = document.querySelector(".chatbox");

let usermessage;
const API_KEY = "AIzaSyCu6ZBgzkmffHKfCWJ8YqCYCzCiLXEmVag";

const createChatLi = (message, className) => {
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", className);
    let chatContent = className === "outgoing" ? 
        `<p>${message}</p>` : 
        `<span class="material-icons-outlined">smart_toy</span><p>${message}</p>`;
    chatLi.innerHTML = chatContent;
    return chatLi;
};

const generateResponse = (incomingChatLi) => {
    const API_URL = `https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=${API_KEY}`;
    const messageElement = incomingChatLi.querySelector("p");

    const requestOptions = {
        method: "POST",
        headers: { 
            "Content-Type": "application/json" 
        },
        body: JSON.stringify({ 
            contents: [{ 
                role: "user", 
                parts: [{ text: usermessage }] 
            }] 
        }),
    };

    fetch(API_URL, requestOptions)
        .then((res) => res.json())
        .then((data) => {
            if (data.candidates && data.candidates[0].content && data.candidates[0].content.parts[0].text) {
                messageElement.textContent = data.candidates[0].content.parts[0].text;
            } else {
                messageElement.textContent = "No response from the API.";
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            messageElement.textContent = "Oops! Something went wrong. Please try again.";
        })
        .finally(() => {
            scrollToBottom();
        });
};

// Check if the user is at the bottom of the chatbox
const isScrolledToBottom = () => {
    return chatbox.scrollHeight - chatbox.scrollTop === chatbox.clientHeight;
};

// Scroll to the bottom if the user is at the bottom
const scrollToBottom = () => {
    if (isScrolledToBottom()) {
        chatbox.scrollTo(0, chatbox.scrollHeight);
    }
};

const handleChat = () => {
    usermessage = chatInput.value.trim(); // Corrected to use `.value`
    if (!usermessage) return;
    
    chatbox.appendChild(createChatLi(usermessage, "outgoing"));
    scrollToBottom();

    setTimeout(() => {
        const incomingChatLi = createChatLi("Thinking...", "incoming");
        chatbox.appendChild(incomingChatLi);
        scrollToBottom();
        generateResponse(incomingChatLi);
    }, 600);

    // Clear the input field after sending the message
    chatInput.value = "";
};

// Add event listener to the send button
sendChatBtn.addEventListener("click", handleChat);
