@extends('app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top sticky-top">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Esconder</span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <a href="/productos" class="btn btn-primary">Volver</a>
            </ul>
        </div>
    </div>
</nav>

<h2>Detalles del producto: {{$producto->nombre}}</h2>

<nav class="navbar navbar-toggler navbar-expand-lg navbar-light bg-light fixed-top sticky-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a href="/productos" class="btn btn-primary">Editar</a><!-- redirecciona a la funcion edit -->
            <a href="/productos" class="btn btn-primary ml-2">Eliminar</a><!-- redirecciona a la funcion destroy -->
        </div>
    </div>
</nav>

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Visible</th>
        <th scope="col">Categoria</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Estado</th>
        
      </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$producto->id}}</th>
            <td>{{$producto->nombre}}</td>
            <td>{{($producto->activo) == 0 ? "NO": "SI"}}</td>
            <td>{{$producto->categoria_nombre}}</td>
            <td>${{$producto->precio}}</td>
            <td>{{$producto->stock}}</td>
            <td>{{$producto->descripcion}}</td>
            <td>{{$producto->estado}}</td>
        </tr>
    </tbody>
  </table>
  
  <img src="\img\default_image.png" class="img-thumbnail" >
@endsection

@section('scripts')
<script>cambiar('productos');</script>
@endsection