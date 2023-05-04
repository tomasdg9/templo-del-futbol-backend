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

        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <a href="{{ url()->route('pedidos.principio') }}" class="btn btn-primary">Ir al principio</a>
            </ul>
        </div>
    </div>
</nav>


<h2>Selecciona el cliente para ver más detalles sobre su pedidos</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Cliente</th>
        <th scope="col">Cantidad de productos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalle_pedidos as $detalle_pedido) 
            <tr>
                <th scope="row">{{$detalle_pedido->id}}</th>
                
                <td><a href="{{ route('pedidos.show', ['pedido' => $detalle_pedido->id]) }}">{{$detalle_pedido->pedido->email}}</a></td>
                
                <th scope="row">{{$detalle_pedido->pedido->getCantidadProductos()}}</th>
            </tr>
        @endforeach
    </tbody>
  </table>

  <div class="container">
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            @if ($page > 1)
                <a href="/pedidos/page/{{$page-1}}" class="btn btn-success mr-2">< Anterior</a>
            @endif
            @if ($tieneProx)
                <a href="/pedidos/page/{{$page+1}}" class="btn btn-success">Siguiente ></a>        
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>cambiar('pedidos');</script>
@endsection