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

@if (session('error'))
  <h6 class="alert alert-danger">{{ session('error') }}</h6>
@endif

<div class="d-flex justify-content-end">
    <form class="form-inline" action="{{ route('clientes.searchByName') }}" method="POST">
         @csrf
        <div class="form-group mx-sm-3 mb-2">
            <label for="name" class="sr-only">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="cliente@email.com">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    </form>
</div>

<h2>Selecciona el email de un cliente para ver sus estadisticas</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Email</th>
        <th scope="col">Cantidad de pedidos</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <th scope="row">{{$cliente->id}}</th>
                <td><a href="{{ route('clientes.show', ['cliente' => $cliente->email]) }}">{{$cliente->email}}</a></td>
                <td>{{$cliente->cantidadPedidos}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            @if ($page > 1)
                <a href="/clientes/page/{{$page-1}}" class="btn btn-success mr-2">< Anterior</a>
            @endif
            @if ($tieneProx)
                <a href="/clientes/page/{{$page+1}}" class="btn btn-success">Siguiente ></a>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>cambiar('clientes');</script>
@endsection
