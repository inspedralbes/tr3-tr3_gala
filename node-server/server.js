const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);


app.use(express.json());


io.on('connection', (socket) => {
  console.log('a user connected');

  socket.on('disconnect', () => {
    console.log('user disconnected');
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