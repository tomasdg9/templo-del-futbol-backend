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
                <a href="/pedidos" class="btn btn-primary">Volver</a>
            </ul>
        </div>
    </div>
</nav>


<h2>Detalles del pedido del cliente: {{$detalle_pedido->email}}</h2>
<p><b>Creado</b>: {{\Carbon\Carbon::parse($detalle_pedido->created_at)->format('d-m-Y H:i') }}</p>
<p><b>Costo Total</b>: ${{number_format($detalle_pedido->getCostoTotal(), 2, ',', '.')}}</p>
<br>
<p>Productos del pedido:</p>
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
      @foreach($productos as $producto)
        <tr>
            <th scope="row"><a href="/productos/{{$producto->id}}">{{$producto->id}}</a></th>
            <td><a href="{{ route('productos.show', ['producto' => $producto->id]) }}">{{$producto->nombre}}</a></td>
            <td>{{($producto->activo) == 0 ? "NO": "SI"}}</td>
            <td><a href="{{ route('categorias.show', ['categoria' => $producto->categoria->id]) }}">{{$producto->categoria->nombre}}</a></td>
            <td>${{number_format($producto->precio, 2, ',', '.')}}</td>
            <td>{{$producto->stock}}</td>
            <td>{{$producto->descripcion}}</td>
            <td>{{$producto->estado}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>


@endsection

@section('scripts')
<script>cambiar('pedidos');</script>
@endsection
