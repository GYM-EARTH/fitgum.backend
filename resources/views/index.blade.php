<!doctype html>
<html>
<head>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    <example-component></example-component>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
