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
@php
    $costoTotal = 0;
@endphp
@foreach ($clientes as $pedido) <!-- Ejecutamos dos foreach pero el rendimiento no se ve afectado tal que, O(2n) -> O(n) -->
    @php
        $costoTotal += $pedido->getCostoTotal();
    @endphp
@endforeach
<p>Gastó en total ${{$costoTotal}}</p>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID del pedido</th>
        <th scope="col">Fecha</th>
        <th scope="col">Cantidad productos</th>
        <th scope="col">Gastó</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $pedido) <!-- ACLARACIÓN: Interpretamos a "Cliente" como el email de un "Pedido" que puede ser repetido. -->
            <tr>
                <th scope="row"><a href="/pedidos/{{$pedido->id}}">{{$pedido->id}}</a></th>
                <td>{{$pedido->created_at}}</td>
                <td>{{$pedido->getCantidadProductos()}}</td>
                <td>${{$pedido->getCostoTotal()}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection

@section('scripts')
<script>cambiar('clientes');</script>
@endsection
