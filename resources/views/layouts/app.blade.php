<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>J-Goal | @yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid">
        @yield('content')
    </div>    
</body>
</html>
