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
                <a href="/productos" class="btn btn-primary">Crear nuevo producto</a>
            </ul>
        </div>
    </div>
</nav>

<h2>Selecciona el nombre de un producto para ver más detalles</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Categoria</th>
        <th scope="col">Stock</th>
        <th scope="col">Visible</th>
        <th scope="col">Precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto) 
            <tr>
                <th scope="row">{{$producto->id}}</th>
                <td><a href="{{ route('productos.show', ['producto' => $producto->id]) }}">{{$producto->nombre}}</a></td>
                <th scope="row">{{$producto->categoria_nombre}}</th>
                <th scope="row">{{$producto->stock}}</th>
                <th scope="row">{{($producto->activo) == 0 ? "NO": "SI"}}</th>
                <th scope="row">${{ $producto->precio}}</th>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection

@section('scripts')
<script>cambiar('productos');</script>
@endsection