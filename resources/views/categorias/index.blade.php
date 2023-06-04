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

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            <div class="form-group">
                @if (session('error'))
                    <h6 class="alert alert-danger">{{ session('error') }}</h6>
                @endif
                <a href="/categorias/create" class="btn btn-success">Crear nueva categoria</a>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
<div class="d-flex justify-content-end">
    <form class="form-inline" action="{{ route('categorias.searchByName') }}" method="POST">
         @csrf
        <div class="form-group mx-sm-3 mb-2">
            <label for="name" class="sr-only">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    </form>
</div>

<div class="container">
    <div class="row">
        @foreach ($categorias as $categoria)
        <div name="categoria" class="col-md-4 mb-4">
            <div name="{{$categoria->nombre}}">
                <div class="card">
                    <div class="card-body">
                        <div class="h2">
                            {{$categoria->nombre}} ({{$categoria->id}})
                        </div>
                        <div class="h4">
                            {{$categoria->getCantidadProductos()}} productos
                        </div>
                        <br>
                        <p><b>Creación</b>: {{\Carbon\Carbon::parse($categoria->created_at)->format('d-m-Y H:i') }}</p>
                        <p><b>Modificación</b>: {{\Carbon\Carbon::parse($categoria->updated_at)->format('d-m-Y H:i') }}</p>
                        <p><b>Descripción</b>: {{$categoria->descripcion}}</p>
                        <p><b>Visible</b>: {{ $categoria->visible ? 'Si' : 'No' }}</p>
                        <div class="col-md-12 d-flex justify-content-center">
                            <a type="button" href="{{ route('categorias.show', ['categoria' => $categoria->id]) }}" class="btn btn-warning">Ver detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            @if ($page > 1)
                <a href="/categorias/page/{{$page-1}}" class="btn btn-success mr-2">< Anterior</a>
            @endif
            @if ($tieneProx)
                <a href="/categorias/page/{{$page+1}}" class="btn btn-success">Siguiente ></a>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>cambiar('categorias');</script>
@endsection
