const express = require("express");
const { Server } = require("socket.io");
const http = require("http");
const mysql = require("mysql2");
const app = express();
const httpServer = http.createServer(app);

const io = new Server(httpServer, {
    cors: {
        origin: "http://localhost", // The client URL
        methods: ["GET", "POST"],
    },
});
// Database connection
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "todo",
});

db.connect((err) => {
    if (err) {
        console.error("Database connection failed: " + err.stack);
        return;
    }
    console.log("Connected to todo database");
});

// Listen for client connections
io.on("connection", (socket) => {
    console.log("A user connected:", socket.id);

    // Send the current tasks to the newly connected client
    socket.emit("initialize");

   // Add new task to the database and broadcast it
   socket.on("add task", (task) => {
    const validNamePattern = /^[a-zA-Z0-9 ]+$/; 

    if (!validNamePattern.test(task.text)) {
        // If validation fails, send an error message back to the client
        socket.emit("task error", {
            message: "Task name should not contain special characters.",
        });
        return; // Stop further execution if validation fails
    }

    // If validation passes, insert the task into the database
    const sql = "INSERT INTO tachee (nom, date, etat, plan_name) VALUES (?, NOW(), ?, ?)";
    const values = [task.text, "To Do", task.plan_name]; // Set etat to 'To Do' by default

    db.query(sql, values, (err, result) => {
        if (err) {
            console.error("Error inserting task:", err);
            return;
        }
        console.log("Task inserted into DB:", result);
        task.id = result.insertId; // Assign the ID from the database
        io.emit("add task", task); // Broadcast task to all clients
    });
});

    socket.on("update task", (updatedTask) => {
        const sql = "UPDATE tachee SET etat = ?, nom = ? WHERE id = ?";
        const values = [updatedTask.completed ? 'Done' : (updatedTask.inProgress ? 'In Progress' : 'To Do'), updatedTask.text, updatedTask.id];
    
        db.query(sql, values, (err, result) => {
            if (err) {
                console.error("Error updating task:", err);
                return;
            }
            console.log("Task updated:", result);
            io.emit("update task", updatedTask); // Broadcast the updated task
        });
    });    

    // Modify task name
    socket.on("modify task name", (updatedTask) => {
        const validNamePattern = /^[a-zA-Z0-9 ]+$/; // Only allow letters, numbers, and spaces
    
        if (!validNamePattern.test(updatedTask.text)) {
            socket.emit("task error", { message: "Task name should not contain special characters." });
            return;
        }
    
        const sql = "UPDATE tachee SET nom = ? WHERE id = ?";
        const values = [updatedTask.text, updatedTask.id];
    
        db.query(sql, values, (err, result) => {
            if (err) {
                console.error("Error updating task name:", err);
                socket.emit("task error", { message: "Database error occurred." });
                return;
            }
    
            console.log("Task name updated in database:", result);
    
            // Broadcast the updated task to all clients
            io.emit("modify task name", updatedTask);
        });
    });    
    // Listen for task deletions
    socket.on("delete task", (taskId) => {
        const sql = "DELETE FROM tachee WHERE id = ?";
        db.query(sql, [taskId], (err, result) => {
            if (err) {
                console.error("Error deleting task:", err);
                return;
            }
            console.log("Task deleted:", result);
            io.emit("delete task", taskId); // Broadcast task deletion
        });
    });
    // Handle user connection and disconnection
    socket.on("disconnect", () => {
        console.log("A user disconnected:", socket.id);
    });
});

// Start the server on port 3000
httpServer.listen(3000, () => {
    console.log("Server is running on http://localhost:3000");
});
