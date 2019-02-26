var io = require('socket.io')(6001);
io.on('connection', function (socket) {
    console.log(socket.id);

    //socket.send('Message from server');
    // socket.emit('server-info', 'Version');

    socket.broadcast.send('New user');
});
