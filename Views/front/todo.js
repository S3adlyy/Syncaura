
const socket = io("http://localhost:3000");

const taskInput = document.getElementById("taskInput");
const taskList = document.getElementById("taskList");
const addTaskButton = document.getElementById("addTaskButton");
const inProgressList = document.getElementById("inProgressList");
const doneList = document.getElementById("doneList");
// Get plan_name from URL
const urlParams = new URLSearchParams(window.location.search);
const planName = urlParams.get('planName');  // This will give you the 'planName' from the URL query string
if (planName) {
    planNameDisplay.textContent = planName; // Set plan name
    planNameDisplay.style.fontWeight = "bold";
} else {
    planNameDisplay.textContent = "No Plan Selected"; // Fallback if no plan name is passed
}

// Initialize task list when connected
socket.on("initialize", () => {
    // Get tasks from the server
    socket.emit("get tasks");
});

// Listen for new tasks from the server
socket.on("add task", (task) => {
    document.getElementById("error-message").textContent = "";
    addTaskToDOM(task);
});
document.getElementById("taskInput").addEventListener("input", () => {
document.getElementById("error-message").textContent = ""; // Clear error message
 });
 // Listen for the modify task name event from the server
socket.on("modify task name", (updatedTask) => {
    const taskElement = document.getElementById(`task-${updatedTask.id}`);
    if (taskElement) {
        taskElement.innerText = updatedTask.text; // Update the task name in the UI
    }
});

// Assume you have an "Edit" button for each task
document.querySelectorAll('.edit-task-button').forEach(button => {
    button.addEventListener('click', function() {
        const taskId = this.dataset.taskId; // Assume taskId is stored in the data attribute of the button
        const newTaskName = prompt('Enter new task name:'); // Get the new name from the user
        
        if (newTaskName) {
            // Emit the modify task name event
            socket.emit('modify task name', {
                id: taskId,
                text: newTaskName
            });
        }
    });
});

// Listen for task deletions
socket.on("delete task", (taskId) => {
    deleteTaskFromDOM(taskId);
});
// Listen for task updates
socket.on("update task", (updatedTask) => {
    const taskElement = document.getElementById(updatedTask.id);
    if (taskElement) {
        const taskText = taskElement.querySelector(".task-text");
        taskText.textContent = updatedTask.text;
        if (updatedTask.completed) {
            taskElement.classList.add("completed");
            doneList.appendChild(taskElement);
        } else {
            taskElement.classList.remove("completed");
            inProgressList.appendChild(taskElement);
        }
    }
});
socket.on("task error", (error) => {
// Display the error message to the user
const errorContainer = document.getElementById("error-message");
if (errorContainer) {
    errorContainer.textContent = error.message;
    errorContainer.style.color = "red";
    }
});

// Add a new task
addTaskButton.addEventListener("click", () => {
const taskText = taskInput.value.trim();
if (taskText && planName) { // Ensure planName exists
const task = {
    id: Date.now().toString(),
    text: taskText,
    completed: false,
    plan_name: planName // Pass plan_name from URL
};
socket.emit("add task", task); // Emit task to the server with plan_name
taskInput.value = ""; // Clear input
}
});


// Function to add task to the DOM
function addTaskToDOM(task) {
    const taskElement = document.createElement("div");
    taskElement.id = task.id;
    taskElement.classList.add("task");
    taskElement.setAttribute("draggable", true);
    taskElement.ondragstart = (event) => {
        event.dataTransfer.setData("text/plain", task.id);
    };

    taskElement.innerHTML = `
        <span class="task-text">${task.text}</span>
        <button onclick="deleteTask('${task.id}')">Delete</button> <br>
        <button  class='edit-task-button' style='z-index:3; data-task-id='1''>Edit</button>                 

    `;
    taskList.appendChild(taskElement);
}

// Function to delete a task
function deleteTask(taskId) {
    socket.emit("delete task", taskId);
}

// Function to remove task from DOM
function deleteTaskFromDOM(taskId) {
    const taskElement = document.getElementById(taskId);
    if (taskElement) {
        taskElement.remove();
    }
}

// Allow dropping tasks into columns
function allowDrop(event) 
{
    event.preventDefault();
}

// Handle task drop into a column (mark as completed or not)
function drop(event) 
{
    event.preventDefault();
    const taskId = event.dataTransfer.getData("text/plain");
    const taskElement = document.getElementById(taskId);
    const taskText = taskElement.querySelector('.task-text').textContent;

    if (taskElement) {
    const columnId = event.target.id;
    let completed = false;
    let inProgress = false;
    let newEtat = 'To Do'; // Default state

    // Check which column the task was dropped into and update the 'etat'
    if (columnId === "doneColumn") {
        taskElement.classList.add("completed");
        completed = true;
        newEtat = 'Done';  // Task moved to 'Done'
        doneList.appendChild(taskElement);
    } else if (columnId === "inProgressColumn") {
        taskElement.classList.remove("completed");  // Remove completed class if moved to in-progress
        inProgress = true;
        newEtat = 'In Progress';  // Task moved to 'In Progress'
        inProgressList.appendChild(taskElement);
    } else {
        taskElement.classList.remove("completed");  // Task removed from 'Done' state if moved back to 'To Do'
        newEtat = 'To Do';  // Task moved back to 'To Do'
        taskList.appendChild(taskElement);
    }

    // Emit the updated task with the correct 'etat' value
    socket.emit("update task", {
        id: taskId,
        completed,
        inProgress,
        text: taskText,
        etat: newEtat // Send the updated 'etat' based on the column
    });
   }
}

////////////////mood suggestions 
const moodSelector = document.getElementById('mood');
const suggestionText = document.getElementById('suggestion-text');
const suggestionsContainer = document.getElementById('suggestions-container'); // Add this container in HTML

const suggestions = {
neutral: [
"Take a moment to review your tasks and organize your day. 📝",
"A good time to reflect on your progress so far. 🤔",
"Start by tackling the easiest task on your list to gain momentum. 💪",
"Write down three things you're grateful for today. 🙏",
"Set a timer for 15 minutes to focus on one task. ⏳",
"Rearrange your workspace to feel more productive. 🖥️"
],
stressed: [
"Try a short breathing exercise before tackling your to-do list. 🌬️",
"Take a break and step outside for a few minutes. ☀️",
"Focus on one task at a time, take it slow. 🧘",
"Drink some water to refresh your mind and body. 💧",
"Take a 5-minute stretch break to relieve tension. 🤸‍♀️",
"Close your eyes for a few seconds and breathe deeply. 😌",
"Set a small, achievable goal to get started. 🎯",
"Try listening to calming music for a few minutes. 🎶"
],
motivated: [
"Challenge yourself to finish an extra task today! 🚀",
"Set a personal goal to accomplish two tasks before the end of the day. 🎯",
"Push yourself to start a new task and complete it today! 💥",
"Visualize the satisfaction of completing your tasks. 🌟",
"Give yourself a reward for completing a task, even a small one. 🎉",
"Take a moment to celebrate your progress so far. 🏅",
"Break your tasks into steps and conquer them one by one. 🧗‍♀️",
"Try to exceed your expectations and surprise yourself today! 💪"
]
};

moodSelector.addEventListener('change', function () {
const mood = moodSelector.value;
const moodSuggestions = suggestions[mood];

// Clear previous content
suggestionText.textContent = '';
const existingButton = document.getElementById('relax-game-button');
if (existingButton) existingButton.remove();

if (moodSuggestions && moodSuggestions.length > 0) {
// Generate a random suggestion
const randomSuggestion = moodSuggestions[Math.floor(Math.random() * moodSuggestions.length)];
suggestionText.textContent = randomSuggestion;

// Add a 'Try a game to relax' button if the mood is stressed
if (mood === 'stressed') {
    const relaxButton = document.createElement('button');
    relaxButton.id = 'relax-game-button';
    relaxButton.textContent = 'Try a game to relax';
    relaxButton.style.cssText = `
        margin-top: 10px; 
        padding: 8px 15px; 
        background-color: #4CAF50; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer;
        font-size: 14px;
    `;
    relaxButton.addEventListener('click', function () {
        window.location.href = 'tapgame.php'; // Redirect to tapgame page
    });

    suggestionsContainer.appendChild(relaxButton);
}
} else {
suggestionText.textContent = "Select a mood to see suggestions! 😊";
}
});

window.onload = function() {
    const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
    if (shadowRoot) {
        const logo = shadowRoot.querySelector('#logo');
        if (logo) logo.remove();
    }
     // Initialize draggable tasks and attach delete button listeners
    const tasks = document.querySelectorAll('.task');
    tasks.forEach(task => {
    // Ensure the task is draggable
    task.setAttribute('draggable', 'true');
    
    // Add event listener for the delete button
    const deleteButton = task.querySelector('button');
    deleteButton.addEventListener('click', () => {
        const taskId = task.id;
        deleteTask(taskId); // Emit task deletion via socket
    });

// Ensure the task is draggable
task.ondragstart = (event) => {
    event.dataTransfer.setData("text/plain", task.id);
    };
});

}