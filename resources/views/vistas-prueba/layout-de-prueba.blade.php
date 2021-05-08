<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('links')
    @yield('estilos')
    <style type="text/css" media="screen">
        body{
            width: 100%;
            height: 100vh;
        }
    </style>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div style="width: 100%; height:20%;background-color: black !important"></div>
        {{--  --}}
        {{--  --}}
        {{-- ESTO ES EL LAYOUT Y AQUI SE PONE UNA SECCION QUE QUERES MOSTRAR DE CONTENIDO PERO EN REALIDAD ESTA PARTE SE MANDA A LLAMAR EN CADA VISTA, NO ESTA LLAMA A LAS OTRAS --}}
        {{--  --}}
        {{--  --}}
        @yield('content')
        <div style="width: 100%; height:20%;background-color: black !important"></div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
