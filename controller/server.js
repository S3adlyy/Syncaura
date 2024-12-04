const express = require("express");
const path = require("path");
const mysql = require("mysql2");
const app = express();
const server = require("http").createServer(app);
const io = require("socket.io")(server);
const multer = require("multer");
const fs = require("fs");
const upload = multer({ dest: "uploads/" });


app.post("/upload-audio", upload.single("audio"), (req, res) => {
    if (!req.file) {
        return res.status(400).send("No file uploaded.");
    }

    const filePath = `/uploads/${req.file.filename}`;
    res.status(200).send({ filePath });
});



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

app.post("/upload-image", upload.single("image"), (req, res) => {
    if (!req.file) {
        return res.status(400).send("No image uploaded.");
    }

    const filePath = `/uploads/${req.file.filename}`;
    res.status(200).send({ filePath });
});

app.use("/uploads", express.static(path.join(__dirname, "uploads")));
app.use(express.static(path.join(__dirname, "../views/front/chat/public")));

app.use("/main", express.static(path.join(__dirname, "../views/front/main")));
app.use("/loading_screen", express.static(path.join(__dirname, "../views/front/loading_screen")));
app.use("/Ai", express.static(path.join(__dirname, "../views/front/Ai")));

// Route for serving index.html
app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname, "../views/front/chat/public/index.html"));
});

app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname, "../views/front/Ai/loding3.html"));
});

// WebSocket connection
io.on("connection", (socket) => {

    socket.on('chatMessage', (message) => {
        io.emit('chatMessage', message); // Broadcast the message to all clients
      });

      socket.on("imageMessage", (data) => {
        io.emit("imageMessage", data); // Broadcast the image path to all clients
    });
    //voice message server code
    socket.on("voiceMessage", (data) => {
        io.emit("voiceMessage", data); // Broadcast audio file path and sender
    });
    // Handle new user joining
    socket.on("newuser", ({ username, chatroom }) => {
        const roomNameRegex = /^[a-zA-Z0-9 ]{1,20}$/;
        const usernameRegex = /^[a-zA-Z0-9_]{1,20}$/;
    
        if (!username || !chatroom || 
            !roomNameRegex.test(chatroom) || 
            !usernameRegex.test(username)) {
            socket.emit("error", "Invalid username or chatroom name.");
            return;
        }
    
        socket.username = username;
        socket.chatroom = chatroom;
    
        // Insert user into the database
        const joinDate = new Date().toISOString().slice(0, 19).replace("T", " ");
        const query = "INSERT INTO users (username, join_date, chatroom) VALUES (?, ?, ?)";
        db.query(query, [username, joinDate, chatroom], (err, results) => {
            if (err) {
                console.error("Error inserting user into database: ", err);
                socket.emit("error", "Failed to join the chatroom. Please try again.");
                return;
            }
            console.log("User inserted into database: ", results.insertId);
        });
    
        // Notify other users
        socket.broadcast.emit("update", `${username} joined the ${chatroom} chatroom`);
    });


    // Handle user exit and delete from database
    socket.on("exituser", (username) => {
        // Delete user from database when they exit
        const query = "DELETE FROM users WHERE username = ?";
        db.query(query, [username], (err, results) => {
            if (err) {
                console.error("Error deleting user from database: ", err);
                return;
            }
            console.log(`User ${username} deleted from database`);
        });

        // Notify other users
        socket.broadcast.emit("update", `${username} left the conversation`);
    });

    // Handle message deletion
    socket.on("delete-message", (id) => {
        // Broadcast the deleted message ID to all connected clients
        io.emit("message-deleted", id);
    });

    socket.on("modify-message", (updatedMessage) => {
        // Broadcast the updated message to all connected clients
        io.emit("message-modified", updatedMessage);
    });

    // Handle chat messages
    socket.on("chat", (message) => {
        const timestamp = new Date().toISOString().slice(0, 19).replace("T", " ");
    
        // Fetch the user_id from the users table based on the username
        const queryUserId = "SELECT id FROM users WHERE username = ?";
        db.query(queryUserId, [message.username], (err, results) => {
            if (err) {
                console.error("Error fetching user ID: ", err);
                return;
            }
    
            if (results.length > 0) {
                const userId = results[0].id; // Get the user_id from the query result
    
                // Insert chat message into the database with the user_id
                const queryMessage = "INSERT INTO messages (username, message, timestamp, user_id) VALUES (?, ?, ?, ?)";
                db.query(queryMessage, [message.username, message.text, timestamp, userId], (err, results) => {
                    if (err) {
                        console.error("Error inserting message into database: ", err);
                        return;
                    }
                    console.log("Message inserted into database: ", results.insertId);
                });
            } else {
                console.error("User not found in the database");
            }
        });
    
        // Broadcast message to other users
        socket.broadcast.emit("chat", message);
    });

    // Handle disconnect and remove user from database
    socket.on("disconnect", () => {
        if (socket.username) {
            // Delete user from database when they disconnect
            const query = "DELETE FROM users WHERE username = ?";
            db.query(query, [socket.username], (err, results) => {
                if (err) {
                    console.error("Error deleting user from database: ", err);
                } else {
                    console.log("User deleted from database: ", socket.username);
                }
            });

            // Notify other users
            socket.broadcast.emit("update", `${socket.username} left the conversation`);
        }
        console.log("A user has disconnected");
    });
});

// Start server
server.listen(5000, () => {
    console.log("Server is running on http://localhost:5000");
});