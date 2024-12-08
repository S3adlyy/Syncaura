const socket = io('http://localhost:3000');  // Updated to port 4000

const messageContainer = document.getElementById('send-container');
const messageForm = document.getElementById('send-container');
const messageInput = document.getElementById('message_input');  // Corrected the id from 'message-input' to 'message_input'

const namee = prompt("What is your name?");
appendMessage('You joined');
socket.emit('new-user', namee);

socket.on('chat-message', data => {
    appendMessage(`${data.namee}: ${data.message}`);
});

socket.on('user-connected', namee => {
    appendMessage(`${namee} connected`);
});

socket.on('user-disconnected', namee => {
    appendMessage(`${namee} disconnected`);
});

messageForm.addEventListener('submit', e => {
    e.preventDefault();
    const message = messageInput.value;
    appendMessage(`You: ${message}`);
    socket.emit('send-chat-message', message);
    messageInput.value = '';
});

function appendMessage(message) {
    const messageElement = document.createElement('div');
    messageElement.innerText = message;
    messageContainer.append(messageElement);
}
