const { createServer } = require("http");
const { Server } = require("socket.io");

// Create an HTTP server and init l socket.io
const httpServer = createServer();
const io = new Server(httpServer, {
    cors: {
        origin: "http://localhost", // URl mt3 l client 
        methods: ["GET", "POST"],
    },
});

// taskes bech yt7atou fi wist array tasks
let tasks = [];

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
            tasks[index] = updatedTask; // Update the task
            console.log("Task updated:", updatedTask);
            io.emit("update task", updatedTask); // Send updated task to all clients
        } else {
            console.error("Task not found for update:", updatedTask.id);
        }
    });

    // Handle disconnections
    socket.on("disconnect", () => {
        console.log("A user disconnected:", socket.id);
    });
});

// Start the server on port 3000
httpServer.listen(3000, () => {
    console.log("Server is running on port 3000");
});
