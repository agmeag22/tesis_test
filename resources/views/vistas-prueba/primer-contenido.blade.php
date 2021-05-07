@extends('vistas-prueba.layout-de-prueba')
{{--  --}}
{{-- Con extends  se manda a llamar el layout --}}
{{--  --}}

@section('estilos')
@endsection
<style type="text/css" media="screen">
    .cst-flex{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 60%;
        flex-direction: column;
    }
</style>
@section('links')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
@endsection
@section('content')
{{--  --}}
{{-- Las secciones o sections son apartados que pueden ser cualquier cosa que se colocaran en el layout especificado en extends, el layout se manda a llamar desde esta vista . --}}
{{--  --}}

<div class="container cst-flex">
    ESTE ES EL CONTENIDO

    <div class="btn btn-primary">
    {{$mensaje_prueba1}}
    </div>
    @foreach($mensaje_prueba2 as $key => $renombre_variable)

    <div class="btn btn-dark m-2">
        {{$renombre_variable}}
    </div>
    @endforeach
</div>
@endsection
