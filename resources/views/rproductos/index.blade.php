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

    </div>
</nav>

<h2>Selecciona fecha inicial y final para ver los productos</h2>
<form  method="POST" action="{{route('rproductos.store')}}">
    @csrf
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top sticky-top">
        <div class="container-align">
            <label for="start">Fecha inicial: </label>
            <input type="date" id="start" name="start" min="2018-01-01" max="2024-12-31">
            <label for="start">Fecha final: </label>
            <input type="date" id="finish" name="finish" min="2018-01-01" max="2024-12-31">

            <button type="submit" class="btn btn-info">
                <span>Filtrar</span>
            </button>
        </div>
    </nav>
</form>

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
                <th scope="row">${{ $producto->precio}}</th>
            </tr>
        @endforeach
    </tbody>
  </table>
  <div class="container">
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            @if ($page > 1)
                <a href="/rproductos/page/{{$inicio}}/{{$fin}}/{{$page-1}}" class="btn btn-success mr-2">< Anterior</a>
            @endif
            @if ($tieneProx)
            <a href="/rproductos/page/{{$inicio}}/{{$fin}}/{{$page+1}}" class="btn btn-success">Siguiente ></a>
            @endif
        </div>
    </div>
</div>




@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>cambiar('rproductos')</script>
    <!--<script>fechaActual('start')</script>
    <script>fechaActual('finish')</script>-->
@endsection
