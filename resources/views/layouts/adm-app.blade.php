<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
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

        .cst-flex-content{
            display: flex;
            flex-direction: row;
        }

        .cst-sidebar{
        }

        .cst-content{
            width: 100% !important;
            background-color: gray;
            height: 80vh !important;
        }

        .cst-nav-content{
            width: 100%;
            display: flex;
            flex-direction: column;

        }


        .accordion {
          background-color: #eee;
          color: #444;
          cursor: pointer;
          padding: 18px;
          width: 100%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 15px;
          transition: 0.4s;
      }

      .active, .accordion:hover {
          background-color: #ccc; 
      }

      .panel {
          display: none;
          background-color: white;
      }
  </style>
  @yield('style')
  @yield('links')
</head>
<body>
    <div id="app" class="cst-flex-content">
        <div class="cst-sidebar">
            <button class="accordion">Section 1</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <button class="accordion">Section 1</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <button class="accordion">Section 1</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>
        <div class="cst-nav-content">
            <nav class="navbar navbar-default navbar-static-top cst-navbar">
                HEADER
            </nav>
            <div class="cst-content">
                @yield('content')
            </div>
            <footer class="cst-footer">
                FOOTER
            </footer>
        </div>
    </div>

    @yield('scripts')
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;
        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
              panel.style.display = "none";
          } else {
              panel.style.display = "block";
          }
      });
      }
  </script>
</body>
</html>
