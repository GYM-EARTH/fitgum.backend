<!doctype html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
</head>
<body>
<ul id="messages"></ul>
<form action="">
    <input id="m" autocomplete="off"/>
    <button>Send</button>
</form>

<script>
    let socket = io(':6001');
    socket.on('message', function (data) {
        console.log(data);
    })
</script>
</body>
</html>
