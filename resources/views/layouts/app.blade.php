<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>J-Goal | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="container-fluid">
        @yield('content')
    </div>    
</body>
</html>
