<?php
include('../../controller/plancontroller.php');
$planController = new PlanController();
$plans = $planController->listPlans();
$planName = $_GET['planName'];
$tasks = $planController->listTaskByPlanName($planName);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <style>
        /* General styles for body and main container */
        html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f5;
    transition: background-color 0.5s;
}

.spline-viewer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 1;
}

.plan-name {
    position: absolute;
    top: 50px;
    left: 50%;
    transform: translateX(-50%); /* Ensure proper centering */
    font-family: 'Segoe UI', sans-serif;
    font-size: 32px;
    z-index: 2;
    color: white;
    text-align: center;
}

.container {
    display: flex;
    justify-content: space-around;
    width: 95%; /* Improve responsiveness */
    max-width: 1200px;
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    padding: 20px;
    overflow: hidden;
    transition: transform 0.5s ease;
}

.column {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    width: 30%;
    padding: 20px;
    overflow-y: auto;
    max-height: 500px;
    position: relative;
    transition: background-color 0.3s, box-shadow 0.3s;
}

.column h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
    text-transform: uppercase;
    transition: color 0.3s;
}

#todoColumn {
    background-color: #e9f7fe;
}

#inProgressColumn {
    background-color: #fff3cd;
}

#doneColumn {
    background-color: #d4edda;
}

input[type="text"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s;
}

input[type="text"]:focus {
    border-color: #007BFF;
}

button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007BFF;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

.task {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    margin: 5px 0;
    background-color: #f9f9f9;
    border-radius: 5px;
    cursor: move;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    word-wrap: break-word; /* Ensure text wraps when too long */
}

.task:hover {
    transform: scale(1.02); /* Slightly enlarge task on hover */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
}

.task .task-text {
    flex-grow: 1; 
    margin-right: 10px; 
    word-wrap: break-word; 
    white-space: pre-wrap; 
}

.task.completed .task-text {
    text-decoration: line-through;
    color: #888;
}

.task .move-buttons {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.task button {
    flex-shrink: 0;
    width: 80px; /* Fixed width for buttons */
    height: 30px; /* Fixed height for buttons */
    border-radius: 5px;
    font-size: 14px;
    white-space: nowrap; /* Prevent text wrapping inside buttons */
    overflow: hidden;
    text-align: center;
}

.task.fade-in {
    animation: fadeIn 0.5s ease;
}

/* Clearfix for ensuring content after the container doesn't interfere */
.clearfix::after {
    content: "";
    display: table;
    clear: both;
}

.new-section {
    left: 10px;   /* Horizontal position (X) */
    top: 50px;   /* Horizontal position (X) */
    margin-top: 20px; /* Add space between the columns and the new section */
    padding: 20px;
    z-index: 2;
    background-color: rgba(240, 240, 245, 0.9); /* Similar background for consistency */
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    
}


@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
</head>
<body>
    <div class="plan-name" id="planNameDisplay"></div>
    <br>
    <div class="container">
        <br><br><br>
        <div class="column" id="todoColumn" ondrop="drop(event)" ondragover="allowDrop(event)">
            <h1>To Do</h1>
            <input type="text" id="taskInput" placeholder="Enter a new task">
            <div id="error-message"></div>
            <button id="addTaskButton">Add Task</button>
            <div id="taskList"></div>
            <?php foreach ($tasks as $task) {
            if ($task['etat'] === 'To Do') {
                echo "<div class='task' id='{$task['id']}' draggable='true'>
                            <span class='task-text'>{$task['nom']}</span>
                            <button onclick='deleteTask(\"{$task['id']}\")'>Delete</button>                 
                    </div>";
            }
                } ?>
            
        </div>

        <div class="column" id="inProgressColumn" ondrop="drop(event)" ondragover="allowDrop(event)">
            <h1>In Progress</h1>
            <div id="inProgressList"></div>
            <?php foreach ($tasks as $task) {
            if ($task['etat'] === 'In Progress') {
            echo "<div class='task' id='{$task['id']}' draggable='true'>
                        <span class='task-text'>{$task['nom']}</span>
                        <button onclick='deleteTask(\"{$task['id']}\")'>Delete</button>                 
                </div>";
                    }
            } ?>

        </div>

        <div class="column" id="doneColumn" ondrop="drop(event)" ondragover="allowDrop(event)">
            <h1>Done</h1>
            <div id="doneList"></div>
            <?php foreach ($tasks as $task) {
            if ($task['etat'] === 'Done') {
            echo "<div class='task' id='{$task['id']}' draggable='true'>
                        <span class='task-text'>{$task['nom']}</span>
                        <button onclick='deleteTask(\"{$task['id']}\")'>Delete</button>                 
                </div>";
                }
                } ?>
        </div>
    </div>
    <div class="clearfix"></div>

<!-- New Section Below the Container -->
<div class="new-section">
    <h2>Mood Helper</h2>
    <label for="mood">Select Your Mood:</label>
        <select id="mood" name="mood">
            <option value="" disabled selected>Select your mood...</option>
            <option value="neutral"> Neutral😌</option>
            <option value="stressed"> Stressed😟</option>
            <option value="motivated"> Motivated😁</option>
        </select>
        <div id="suggestions" class="suggestions-box">
            <h3>Suggestions</h3>
            <p id="suggestion-text">Select a mood to get started!😊</p>
            <a href="tapgame.php?planName=<?php echo urlencode($_GET['planName']); ?>"style="text-decoration: none; color: #4CAF50; font-weight: bold;">Play "Catch the Emoji" Game to relax 🎮</a>
        </div>
</div> 

    <div class="spline-viewer">
        <spline-viewer url="https://prod.spline.design/NlYMwsWFwYQczsL5/scene.splinecode"></spline-viewer>
    </div>

    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.35/build/spline-viewer.js"></script>
    <script>
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
                <button onclick="deleteTask('${task.id}')">Delete</button>
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


    </script>
    <script>
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
    </script>





</body>
</html>
