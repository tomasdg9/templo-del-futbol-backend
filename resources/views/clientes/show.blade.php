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
                <a href="/clientes" class="btn btn-primary">Volver</a>
            </ul>
        </div>
    </div>
</nav>

<h2>Estadisticas sobre el cliente {{$clientes->first()->email}}</h2>
<p>Realizó {{$clientes->count()}} pedido(s).</p>
<p>Primer pedido {{$clientes->first()->created_at}}</p>
<p>Último pedido {{$clientes->last()->created_at}}</p>

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID del pedido</th>
        <th scope="col">Fecha</th>
        <th scope="col">Cantidad productos</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente) <!-- Misma complejidad -> O(2n) = O(n) -->
            <tr>
                <th scope="row">{{$cliente->id}}</th>
                <td>{{$cliente->created_at}}</td>
                <td>{{ $cliente->getCantidadProductos() }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection

@section('scripts')
<script>cambiar('clientes');</script>
@endsection
