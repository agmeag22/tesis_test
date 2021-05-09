<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css" media="screen">
        body{
            width: 100%;
            margin: 0 !important;
            height: 100vh;
        }

        .cst-navbar{
            height: 10vh !important;
            background-color: cornflowerblue;
        }

        .cst-footer{
            height: 10vh !important;
            background-color: cornflowerblue;
        }

        .cst-container{
            background-color: gray;
            height: 80vh !important;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top cst-navbar">
            HEADER
        </nav>

        @yield('content')
        <footer class="cst-footer">
            FOOTER
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
