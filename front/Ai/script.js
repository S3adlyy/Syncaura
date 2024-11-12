const chatbot = document.getElementById("chatbot");
const chatbotIcon = document.getElementById("chatbot-icon");

// Toggle the visibility of the chatbot when the icon is clicked
chatbotIcon.addEventListener("click", () => {
    if (chatbot.style.display === "none" || chatbot.style.display === "") {
        chatbot.style.display = "flex"; // Show the chatbot
    } else {
        chatbot.style.display = "none"; // Hide the chatbot
    }
});