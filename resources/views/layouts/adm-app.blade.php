<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
    <!--===============================================================================================-->
    <link href="/fontawesome/css/all.css" rel="stylesheet"> 
    <style type="text/css" media="screen">

        @font-face {
            font-family: Roboto;
            src: url('/fonts/Roboto/Roboto.ttf');
        }


        *:not(i,p) {
            font-family: 'Roboto' !important;
        }

        body{
            width: 100%;
            margin: 0 !important;
            height: 100vh;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .cst-navbar{
            background-color: white;
            height: 10vh;
            display: flex;
            /* justify-content: flex-end; */
            width: 100%;
            justify-content: flex-end;
            align-items: center;
        }

        .cst-footer{
            background-color: #fff;
            height: 4vh;
            box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 50%) !important;
        }

        .cst-flex-content{
            display: flex;
            flex-direction: row;
        }

        .cst-sidebar{
            background-color: #0f2743;
        }

        .cst-content{
            width: 100% !important;
            height: 86vh !important;
        }

        .cst-nav-content-fot{
            width: 100%;
            display: flex;
            flex-direction: column;

        }


        /*SIDEBAR*/
        a { text-decoration: none; }

        .btnMenu {
            display: none;
            padding: 20px;
            display: block;
            background: #1abc9c;
            color: #fff;
        }

        .btnMenu i.fa { float: right; }

        .contenedor-menu {
            display: inline-block;
            line-height: 18px;
        }

        .contenedor-menu .menu { width: 100%; }

        .contenedor-menu ul { list-style: none; }

        .contenedor-menu .menu li a {
            color: #494949;
            display: block;
            padding: 15px 20px;
                background: #fff;
        }
        .contenedor-menu .menu li a:hover { background: #1665a0; color: #fff; } 
        .contenedor-menu .menu i.fa { 
            font-size: 12px; 
            line-height: 18px; 
            float: right; 
            margin-left: 10px; 
        }

        .contenedor-menu .menu ul { display: none; }
        .contenedor-menu .menu ul li a {
            background: #424242;
            color: #e9e9e9;
        }

        .contenedor-menu .menu .activado > a {
            background: #1665a0; 
            color: #fff;
        }
        /*SIDEBAR*/

        .cst-logo-cont{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 12vh;
        }

        .cst-logo{
            width:20%;
        }

        .cst-footer{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #00000078;
        }

        html, body, .v-application, .v-application--wrap {
            min-height: -webkit-fill-available;
        }

        .v-application--wrap{
            min-height: 88vh !important;
        }

        .cst-profile{
            background-color: white;
            border-radius: 50%;
            width: 5vh;
            height: 5vh;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: black;
            transition:  0.5s linear;
        }

        .cst-profile:hover{
            background-color: #ff6f60;
            color: white;
        }

        .cst-btns-cont{
            border-radius: 26px;
            width: 15vh;
            height: 6vh;
            background-color: #0f2743;
            justify-content: space-between;
            margin-right:20px;
        }


        .cst-flex-h{
            display: flex;
            flex-direction: row;
        }

        .cst-flex-v{
            display: flex;
            flex-direction: column;
        }

        .cst-flex-center{
            justify-content: center;
            align-items: center;
        }

        .cst-flex-spacearound{
            justify-content: space-around;
        }

        .dropdown-content {
          display: none;
          position: absolute;
          
          background-color: #f9f9f9;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          border-radius: 12px;
          top: 58px;
          /*padding:50px;*/
          width: 20vh;
      }

      .dropdown:hover .dropdown-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .cst-link{
        margin-top: 10px;
        margin-left: 20px;
        margin-bottom: 10px;

    }

</style>
@yield('style')
@yield('links')
</head>
<body>
    <div id="app" class="cst-flex-content">
        <div class="cst-sidebar contenedor-menu ">
            <div class="cst-logo-cont">
                <img src="/img/icon/logo-uca.png" alt="" class="cst-logo">
            </div>
            <ul class="menu">
                <li><a href="#">Gestionar Indices<i class="fa fa-chevron-down"></i></a>
                    <ul>
                        <li><a href="/administration/iudop/secret/indice/indice">Listado Indices</a></li>
                    </ul>
                </li>
                <li><a href="#">Gestionar Informes<i class="fa fa-chevron-down"></i></a>
                    <ul>
                        <li><a href="/administration/iudop/secret/informe/informe">Listado Informes</a></li>
                    </ul>
                </li>
                <li><a href="#">Gestionar Categorías<i class="fa fa-chevron-down"></i></a>
                    <ul>
                        <li><a href="/administration/iudop/secret/categoria/categoria">Listado Categorias</a></li>
                    </ul>
                </li>
                <li><a href="#">Gestionar Subcategorías<i class="fa fa-chevron-down"></i></a>
                    <ul>
                        <li><a href="/administration/iudop/secret/subcategoria/subcategoria">Listado SubCategorias</a></li>
                    </ul>
                </li>
                <li><a href="#">Gestionar accesos<i class="fa fa-chevron-down"></i></a>
                    <ul>
                        <li><a href="/administration/iudop/secret/usuario/usuario">Usuarios</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="cst-nav-content-fot">
            <nav class="navbar navbar-default navbar-static-top cst-navbar">
                <div class="cst-btns-cont cst-flex-h cst-flex-center cst-flex-spacearound">

                    <div class="cst-profile dropdown">
                        <i class="fas fa-cogs"></i>
                        <div class="dropdown-content">
                            <a href="{{url('/administration/iudop/secret/logout')}}" class="cst-link"><i class="fas fa-power-off"></i>  Logout</a>
                        </div>
                    </div>
                    
                </div>
            </nav>
            <div class="cst-content">
                @yield('content')
            </div>
            <footer class="cst-footer">
                <div>
                    Instituto Universitario de Opinión Pública | @Copyright 2021
                </div>

            </footer>
        </div>
    </div>

    <script src="/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.menu li:has(ul)').click(function(e) {
                e.preventDefault();

                if($(this).hasClass('activado')) {
                    $(this).removeClass('activado');
                    $(this).children('ul').slideUp();
                } else {
                    $('.menu li ul').slideUp();
                    $('.menu li').removeClass('activado');
                    $(this).addClass('activado');
                    $(this).children('ul').slideDown();
                }

                $('.menu li ul li a').click(function() {
                    window.location.href = $(this).attr('href');
                })
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
