const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

let connectedUsers = [];

io.on('connection', (socket) => {
  console.log('a user connected');
  connectedUsers.push(socket.id);

  socket.on('disconnect', () => {
    console.log('user disconnected');
    connectedUsers = connectedUsers.filter(user => user !== socket.id);
  });

  socket.on('seatPurchased', (seat) => {
    io.emit('seatPurchased', seat);
  });
});

server.listen(4520, () => {
  console.log('listening on *:4520');
});