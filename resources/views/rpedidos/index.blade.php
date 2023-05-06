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

<h2>Selecciona fecha inicial y final para ver los pedidos</h2>
<form  method="POST" action="{{route('rpedidos.store')}}">
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
        <th scope="col">Cliente</th>
        <th scope="col">Cantidad de productos</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($pedidos as $pedido) 
            <tr>
                <th scope="row">{{$pedido->id}}</th>
                
                <td><a href="{{ route('pedidos.show', ['pedido' => $pedido->id]) }}">{{$pedido->pedido->email}}</a></td>
                
                <th scope="row">{{$pedido->pedido->getCantidadProductos()}}</th>
            </tr>
        @endforeach
    </tbody>
  </table>



@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>cambiar('rpedidos')</script>
@endsection