<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            HEADER
        </nav>

        @yield('content')
        <footer>
            FOOTER
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
