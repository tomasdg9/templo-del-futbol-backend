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

<h2>Selecciona el cliente para ver más detalles</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Cliente</th>
        <th scope="col">Nombre de producto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalle_pedidos as $detalle_pedido) 
            <tr>
                <th scope="row">{{$detalle_pedido->id}}</th>
                <td><a href="{{ route('detalle_pedidos.show', ['detalle_pedido' => $detalle_pedido->id]) }}">{{$detalle_pedido->cliente_email}}</a></td>
                <td>{{$detalle_pedido->producto_nombre}}</td>
                
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection

@section('scripts')
<script>cambiar('pedidos');</script>
@endsection