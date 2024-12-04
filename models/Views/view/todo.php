<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <style>
        /* General styles for body and main container */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            background-color: #f0f0f5;
            transition: background-color 0.5s; /* Smooth background transition */
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
            display: flex;
            justify-content: space-around;
            width: 100%;
            max-width: 1200px; 
            position: relative; 
            z-index: 2; 
            background-color: rgba(255, 255, 255, 0.9); 
            border-radius: 10px; 
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); 
            padding: 20px;
            overflow: hidden;
            transition: transform 0.5s ease; /* Smooth container transition */
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
            transition: background-color 0.3s, box-shadow 0.3s; /* Smooth transitions */
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

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            transition: color 0.3s; /* Smooth color transition */
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s; /* Smooth border transition */
        }

        input[type="text"]:focus {
            border-color: #007BFF; /* Change border color on focus */
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
            transition: background-color 0.3s; /* Smooth background color transition */
        }

        button:hover {
            background-color: #0056b3; /* Darken button on hover */
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
            transition: transform 0.2s, box-shadow 0.2s; /* Smooth transitions */
        }

        .task:hover {
            transform: scale(1.02); /* Slightly enlarge task on hover */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
        }

        .task.completed {
            text-decoration: line-through;
            color: #888;
        }

        .move-buttons {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        /* Animation for task addition */
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

        .task.fade-in {
            animation: fadeIn 0.5s ease; /* Add fade-in animation */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="column" id="todoColumn" ondrop="drop(event)" ondragover="allowDrop(event)">
            <h1>To Do</h1>
            <input type="text" id="taskInput" placeholder="Enter a new task">
            <button id="addTaskButton">Add Task</button>
            <div id="taskList"></div>
        </div>

        <div class="column" id="inProgressColumn" ondrop="drop(event)" ondragover="allowDrop(event)">
            <h1>In Progress</h1>
            <div id="inProgressList"></div>
        </div>

        <div class="column" id="doneColumn" ondrop="drop(event)" ondragover="allowDrop(event)">
            <h1>Done</h1>
            <div id="doneList"></div>
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

    // Initialize task list when connected
    socket.on("initialize", (tasks) => {
        taskList.innerHTML = "";
        tasks.forEach(task => addTaskToDOM(task));
    });

    // Listen for new tasks
    socket.on("add task", (task) => {
        addTaskToDOM(task);
    });

    // Listen for task deletions
    socket.on("delete task", (taskId) => {
        deleteTaskFromDOM(taskId);
    });

    // Listen for task updates
    socket.on("update task", (updatedTask) => {
        const taskElement = document.getElementById(updatedTask.id);
        if (taskElement) {
            taskElement.querySelector(".task-text").textContent = updatedTask.text;
            if (updatedTask.completed) {
                doneList.appendChild(taskElement);
            } else {
                inProgressList.appendChild(taskElement);
            }
        }
    });

    // Add a new task
    addTaskButton.addEventListener("click", () => {
        const taskText = taskInput.value.trim();
        if (taskText) {
            const task = {
                id: Date.now().toString(),
                text: taskText,
                completed: false
            };
            socket.emit("add task", task);
            taskInput.value = "";
        }
    });

    function addTaskToDOM(task) {
        const taskElement = document.createElement("div");
        taskElement.id = task.id;
        taskElement.classList.add("task", "fade-in"); // Add fade-in class
        taskElement.setAttribute("draggable", true); // Make task draggable
        taskElement.ondragstart = (event) => {
            event.dataTransfer.setData("text/plain", task.id); // Store task ID
        };
        taskElement.innerHTML = `
            <span class="task-text">${task.text}</span>
            <div class="move-buttons">
                <button onclick="deleteTask('${task.id}')">Delete</button>
            </div>
        `;
        taskList.appendChild(taskElement);
    }

    // Function to delete a task
    function deleteTask(taskId) {
        socket.emit("delete task", taskId);
    }

    // Function to remove a task from the DOM
    function deleteTaskFromDOM(taskId) {
        const taskElement = document.getElementById(taskId);
        if (taskElement) {
            taskElement.remove();
        }
    }

    // Allow dropping
    function allowDrop(event) {
        event.preventDefault();
    }

    // Handle drop event
    function drop(event) {
        event.preventDefault();
        const taskId = event.dataTransfer.getData("text/plain");
        const taskElement = document.getElementById(taskId);
        
        if (event.target.id === "inProgressColumn") {
            taskElement.querySelector(".task-text").textContent += " (In Progress)"; // Optional: Update task text
            inProgressList.appendChild(taskElement);
        } else if (event.target.id === "doneColumn") {
            taskElement.querySelector(".task-text").textContent += " (Done)"; // Optional: Update task text
            doneList.appendChild(taskElement);
        } else {
            taskList.appendChild(taskElement);
        }

        // Update the task status on the server
        socket.emit("update task", {
            id: taskId,
            text: taskElement.querySelector(".task-text").textContent,
            completed: event.target.id === "doneColumn" // Check if dropped in Done column
        });
    }
    </script>
    <script>
      const splineViewer = document.querySelector('spline-viewer');
        document.addEventListener('mousemove', (event) => {
            const { innerWidth, innerHeight } = window;
            const x = (event.clientX / innerWidth) * 2 - 1;
            const y = -(event.clientY / innerHeight) * 2 + 1;
            const rotationSpeed = 1;
            splineViewer.camera.rotation.x = y * rotationSpeed;
            splineViewer.camera.rotation.y = x * rotationSpeed;
        });

        window.onload = function() {
            const shadowRoot = document.querySelector('spline-viewer').shadowRoot;
            if (shadowRoot) {
                const logo = shadowRoot.querySelector('#logo');
                if (logo) logo.remove();
            }
            if(!shadowRoot){
                const logo =shadowRoot.querySelector('#logo');
                if(nlogo) logo.remove();
            }
        }
    </script>
</body>
</html>



