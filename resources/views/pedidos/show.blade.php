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


<h2>Detalles del pedido del cliente: {{$pedido->email}}</h2>
<p><b>Creado</b>: {{\Carbon\Carbon::parse($pedido->created_at)->format('d-m-Y H:i') }}</p>
<p><b>Costo Total</b>: ${{number_format($pedido->getCostoTotal(), 2, ',', '.')}}</p>
<p><b>ID de pago</b>: {{$pedido->idmp}}</p>
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
      @foreach($detalle_pedidos as $detalle_pedido)
        <tr>
            <th scope="row"><a href="/productos/{{$detalle_pedido->producto->id}}">{{$detalle_pedido->producto->id}}</a></th>
            <td><a href="{{ route('productos.show', ['producto' => $detalle_pedido->producto->id]) }}">{{$detalle_pedido->producto->nombre}}</a></td>
            <td>{{($detalle_pedido->producto->activo) == 0 ? "NO": "SI"}}</td>
            <td><a href="{{ route('categorias.show', ['categoria' => $detalle_pedido->producto->categoria->id]) }}">{{$detalle_pedido->producto->categoria->nombre}}</a></td>
            <td>${{number_format($detalle_pedido->precio, 2, ',', '.')}}</td>
            <td>{{$detalle_pedido->producto->stock}}</td>
            <td>{{$detalle_pedido->producto->descripcion}}</td>
            <td>{{$detalle_pedido->producto->estado}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>


@endsection

@section('scripts')
<script>cambiar('pedidos');</script>
@endsection
