const socket = io('http://localhost:3000');

const server = require('http').createServer();
const io = require('socket.io')(server);

io.on('connection', (socket) => {
  console.log('a user connected');
});

server.listen(3000);
