
<!DOCTYPE html>
<html>
<head>
    <title>IUDOP ADMINISTRATIVO</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link href="/css/tailwind.min.css" rel="stylesheet">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="/css/cst_main.css"> --}}
    <!--===============================================================================================-->
    <style type="text/css">
     body{
        background: url(/img/cubes.png);
        background-size: 107px;
        width: 100%;
        height: 100%;

    }
    .cst-card{
        border-radius: 12px !important;
        padding: 42px !important;
        opacity: 0.9;
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 50%) !important;
        background-color: rgb(0 0 0 / 40%);
        display: flex;
        flex-wrap: wrap;
        margin: 20px;
        justify-content: center;
        align-items: center;
    }

    .cst-container{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }

    .cst-input{
        width: 100%;
        color: white;
        margin-bottom: 14px;
        font-size: 14px;
        height: 35px;
        border: 4px solid black;
        background-color: #efe5e500;
        border-color: transparent !important;
        border-bottom-color: #4ac04a !important;
        font-weight: bold;

    }

    .cst-input:focus ~ .floating-label,
    .cst-input:not(:focus):valid ~ .floating-label{
      position: relative;
      pointer-events: none;
      top: -70px;
      font-size: 14px;
      left: 0px;
      opacity: 1;
      font-weight: bolder !important;
      color:white;
  }

  .cst-input:focus {
    outline: none !important;
    border-bottom-color: green;
}

.floating-label {
    position: relative;
    pointer-events: none;
    top: -43px;
    font-weight: bolder !important;
    left: 10px;
    color: white;
    transition: 0.5s ease all;
}

.no-outline-focus:focus{
    outline: none !important;
}

.cst-btn{
    background-color: black;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    width: 100%;
    padding: 10px;
    border-radius: 50px;
    font-size: 1.2rem;
    transition: 1s ease all;
}

.cst-btn:hover{
    background-color: white;
    color: black;
}

.cst-form{
    margin-top: 20px;
}

@media only screen and (min-width: 768px) {
    .cst-form {
        margin-left: 30px;
    }

}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    transition: background-color 5000s ease-in-out 0s;
    color: white;
}
</style>
</head>
<body>
    <div class="cst-container">

        <div class="cst-card">
            <div class="cst-img-container">
                <img src="/img/.svg" alt="AVATAR" class="w-48  self-center">
            </div>
            <form method="POST" action="{{ route('login') }}" class="cst-form">
                {{ csrf_field() }}

                <div class="form-group row">
                    <input id="username" type="text" class="cst-input  @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    <span class="floating-label">USUARIO</span>
                </div>

                <div class="form-group row">

                    <input id="password" type="password" class="form-control cst-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <span class="floating-label">CONTRASEñA</span>
                </div>
                @if(count( $errors ) > 0)
                @foreach ($errors->all() as $error)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $error }}</strong>
                </span>
                @endforeach
                @endif
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="no-outline-focus cst-btn">
                            INICIAR SESIÓN
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</body>
</html>
