const express = require("express");
const path = require("path");
const mysql = require("mysql2");  // npm install mysql2
const app = express();
const server = require("http").createServer(app);
const io = require("socket.io")(server);

// 
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

// Serve static files from views/front/chat/public
app.use(express.static(path.join(__dirname, "../views/front/chat/public")));

// Route for serving index.html at the root
app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname, "../views/front/chat/public/index.html"));
});

// WebSocket connection
io.on("connection", function(socket) {
    // Handle new user joining
    socket.on("newuser", function(username) {
        // Get the current timestamp for join date
        const joinDate = new Date().toISOString().slice(0, 19).replace("T", " ");

        // Insert the username and join date into the MySQL database
        const query = "INSERT INTO users (username, join_date) VALUES (?, ?)";
        db.query(query, [username, joinDate], (err, results) => {
            if (err) {
                console.error("Error inserting user into database: ", err);
                return;
            }
            console.log("User inserted into database: ", results.insertId);
        });

        // Broadcast user joining
        socket.broadcast.emit("update", username + " joined the conversation");
    });

    // Handle user exit
    socket.on("exituser", function(username) {
        socket.broadcast.emit("update", username + " left the conversation");
    });

    // Handle chat messages
    socket.on("chat", function(message) {
        socket.broadcast.emit("chat", message);
    });

    // Handle disconnect event
    socket.on('disconnect', function() {
        console.log("A user has disconnected");
    });
});

// Start server
server.listen(5000, () => {
    console.log("Server is running on http://localhost:5000");
});
