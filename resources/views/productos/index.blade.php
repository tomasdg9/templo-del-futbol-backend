@extends('app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top sticky-top">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Esconder</span>
        </button>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            <div class="form-group">
                @if (session('error'))
                    <h6 class="alert alert-danger">{{ session('error') }}</h6>
                @endif
                <a href="/productos/create" class="btn btn-success">Crear nuevo producto</a>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
@endif

<div class="d-flex justify-content-end">
    <form class="form-inline" action="{{ route('productos.searchByName') }}" method="POST">
         @csrf
        <div class="form-group mx-sm-3 mb-2">
            <label for="name" class="sr-only">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    </form>
</div>

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
                <th scope="row">{{$producto->categoria->nombre}}</th>
                <th scope="row">{{$producto->stock}}</th>
                <th scope="row">{{($producto->activo) == 0 ? "NO": "SI"}}</th>
                <th scope="row">${{ number_format($producto->precio, 2, ',', '.')}}</th>
            </tr>
        @endforeach
    </tbody>
  </table>
  <div class="container">
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            @if ($page > 1)
                <a href="/productos/page/{{$page-1}}" class="btn btn-success mr-2">< Anterior</a>
            @endif
            @if ($tieneProx)
                <a href="/productos/page/{{$page+1}}" class="btn btn-success">Siguiente ></a>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>cambiar('productos');</script>
@endsection
