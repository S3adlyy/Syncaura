const express = require("express");
const path = require("path");
const http = require("http");
const socketIo = require("socket.io");

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

app.use(express.static(path.join(__dirname, "public")));

app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname, "public", "index.html"));
});

io.on("connection", (socket) => {
    console.log("New client connected");
    socket.on("draw", (data) => {
        socket.broadcast.emit("draw", data);
    });
    socket.on("clear", () => {
        io.emit("clear");
    });

    socket.on("updateSettings", (settings) => {
        socket.broadcast.emit("updateSettings", settings);
    });

    socket.on("disconnect", () => {
        console.log("Client disconnected");
    });
});

server.listen(5100, () => {
    console.log("Server is running on http://localhost:5100");
});

