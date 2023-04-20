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

        <div class="text-right">
            <form class="d-flex">
                <input class="form-control me-2" type="text" id="emailCliente" placeholder="Email del cliente">
                <button class="btn btn-primary" onClick="buscarEmail()" type="button">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<h2>Selecciona el email de un cliente para ver sus estadisticas</h2>
<table class="table" id="clienteEmails">
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
                <th>{{$counts[$cliente->email]}}</th>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection

@section('scripts')
<script>cambiar('clientes');</script>
@endsection
