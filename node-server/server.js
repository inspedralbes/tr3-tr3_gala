const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

// Middleware para analizar el cuerpo de las solicitudes JSON
app.use(express.json());


io.on('connection', (socket) => {
  console.log('a user connected');

  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
});

// Ruta POST para manejar las compras de asientos
app.post('/seatPurchased', (req, res) => {
  const seat = req.body.seat;

  // Emitir el evento 'seatPurchased' a todos los clientes conectados
  io.emit('seatPurchased', seat);

  res.sendStatus(200);
});

server.listen(4520, () => {
  console.log('listening on *:4520');
});