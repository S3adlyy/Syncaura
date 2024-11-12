const express = require("express");
const path = require("path");

const app = express();
const server = require("http").createServer(app);

const io = require("socket.io")(server);

// Serve static files from views/front/chat/public
app.use(express.static(path.join(__dirname, "../views/front/chat/public"))); // this is when you sould put the url

// Route for serving index.html at the root
app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname, "../views/front/chat/public/index.html"));
});

io.on("connection", function(socket) {
    socket.on("newuser", function(username) {
        socket.broadcast.emit("update", username + " joined the conversation");
    });

    socket.on("exituser", function(username) {
        socket.broadcast.emit("update", username + " left the conversation");
    });

    socket.on("chat", function(message) {
        socket.broadcast.emit("chat", message);
    });

    socket.on('disconnect', function() {
        console.log("A user has disconnected");
    });
});

server.listen(5000, () => {
    console.log("Server is running on http://localhost:5000");
});
