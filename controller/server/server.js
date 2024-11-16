const express = require("express");
const { Server } = require("socket.io");
const http = require("http"); // Import the HTTP module

const app = express();
const httpServer = http.createServer(app); // Correctly create an HTTP server

// Initialize Socket.IO with CORS settings
const io = new Server(httpServer, {
    cors: {
        origin: "http://localhost", // URL for the client
        methods: ["GET", "POST"],
    },
});

// Array to store tasks
let tasks = [];
const users = {};

// Listen for client connections
io.on("connection", (socket) => {
    console.log("A user connected:", socket.id);

    // Send the current list of tasks to the newly connected client
    socket.emit("initialize", tasks);

    // Listen for new tasks
    socket.on("add task", (task) => {
        tasks.push(task);
        console.log("Task added:", task);
        io.emit("add task", task); // Send new task to all clients
    });

    // Listen for task deletions
    socket.on("delete task", (taskId) => {
        const initialLength = tasks.length; // Store initial length
        tasks = tasks.filter((task) => task.id !== taskId);
        
        if (tasks.length < initialLength) {
            console.log("Task deleted:", taskId);
            io.emit("delete task", taskId); // Update all clients
        } else {
            console.error("Task not found for deletion:", taskId);
        }
    });

    // Listen for task updates (e.g., marking as done)
    socket.on("update task", (updatedTask) => {
        const index = tasks.findIndex((task) => task.id === updatedTask.id);
        if (index !== -1) {
            const originalText = tasks[index].text.split(" (")[0]; // Keep the base text only
            tasks[index] = {
                ...tasks[index], // Preserve other fields
                text: originalText + (updatedTask.completed ? " (Done)" : " (In Progress)"), // Add latest status
                completed: updatedTask.completed,
            };

            console.log("Task updated:", tasks[index]);
            io.emit("update task", tasks[index]); // Broadcast the updated task
        } else {
            console.error("Task not found for update:", updatedTask.id);
        }
    });

    // Handle user connection events
    socket.on("new-user", (name) => {
        users[socket.id] = name;
        socket.broadcast.emit("user-connected", name);
    });

    // Handle incoming chat messages
    socket.on("send-chat-message", (message) => {
        socket.broadcast.emit("chat-message", {
            message: message,
            name: users[socket.id],
        });
    });

    // Handle user disconnections
    socket.on("disconnect", () => {
        console.log("A user disconnected:", socket.id);
        socket.broadcast.emit("user-disconnected", users[socket.id]);
        delete users[socket.id];
    });
});

// Start the server on port 3000
httpServer.listen(3000, () => {
    console.log("Server is running on http://localhost:3000");
});
