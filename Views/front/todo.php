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
                            <button onclick='deleteTask(\"{$task['id']}\")'>Delete</button> <br>

                            <button  class='edit-task-button' style='z-index:3; data-task-id='1''>Edit</button>                 
          
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
                        <button onclick='deleteTask(\"{$task['id']}\")'>Delete</button> <br>    
                        <button  class='edit-task-button' style='z-index:3; data-task-id='1''>Edit</button>                                                     
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
                        <button onclick='deleteTask(\"{$task['id']}\")'>Delete</button> <br>
                        <button  class='edit-task-button' style='z-index:3; data-task-id='1''>Edit</button>                 
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
    
    <script src="todo.js"></script>




</body>
</html>
