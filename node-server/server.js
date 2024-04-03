const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const cors = require('cors');

const app = express();
app.use(cors());
const server = http.createServer(app);
const io = socketIo(server, {
  cors: {
    origin: "http://localhost:3000",
    methods: ["GET", "POST"],
    credentials: true
  }
});
let connectedUsers = [];

io.on('connection', (socket) => {
  console.log('a user connected');

  socket.on('user connected', (user) => {
    connectedUsers.push(user); 
    console.log('User connected:', user);
  });

  socket.on('disconnect', () => {
    console.log('user disconnected');
    
    connectedUsers = connectedUsers.filter(user => user.id !== socket.id);
  });
});

app.post('/seatPurchased', (req, res) => {
  const seat = req.body.seat;

  io.emit('seatPurchased', seat);

  res.sendStatus(200);
});

server.listen(4520, () => {
  console.log('listening on *:4520');
});