const express = require("express");
const path = require("path");
const mysql = require("mysql2");
const app = express();
const server = require("http").createServer(app);
const io = require("socket.io")(server);

// MySQL database configuration
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "chatroom_db"
});

// Connect to MySQL database
db.connect((err) => {
    if (err) {
        console.error("Database connection failed: " + err.stack);
        return;
    }
    console.log("Connected to MySQL database");
});

// Serve static files
app.use(express.static(path.join(__dirname, "../views/front/chat/public")));

// Route for serving index.html
app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname, "../views/front/chat/public/index.html"));
});

// WebSocket connection
io.on("connection", (socket) => {
    // Handle new user joining
    socket.on("newuser", (username) => {
        // Store username in socket session
        socket.username = username;

        // Insert user into database
        const joinDate = new Date().toISOString().slice(0, 19).replace("T", " ");
        const query = "INSERT INTO users (username, join_date) VALUES (?, ?)";
        db.query(query, [username, joinDate], (err, results) => {
            if (err) {
                console.error("Error inserting user into database: ", err);
                return;
            }
            console.log("User inserted into database: ", results.insertId);
        });

        // Notify other users
        socket.broadcast.emit("update", username + " joined the conversation");
    });

    // Handle user exit
    socket.on("exituser", (username) => {
        socket.broadcast.emit("update", username + " left the conversation");
    });

    // Handle chat messages
    socket.on("chat", (message) => {
        socket.broadcast.emit("chat", message);
    });

    // Handle disconnect and remove user from database
    socket.on("disconnect", () => {
        if (socket.username) {
            const query = "DELETE FROM users WHERE username = ?";
            db.query(query, [socket.username], (err, results) => {
                if (err) {
                    console.error("Error deleting user from database: ", err);
                } else {
                    console.log("User deleted from database: ", socket.username);
                }
            });

            // Notify other users
            socket.broadcast.emit("update", socket.username + " left the conversation");
        }
        console.log("A user has disconnected");
    });
});

// Start server
server.listen(5000, () => {
    console.log("Server is running on http://localhost:5000");
});
