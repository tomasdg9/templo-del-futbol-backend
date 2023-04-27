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

@if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
@endif

        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3 d-flex justify-content-center">
                    <div class="form-group">
                        <a href="/categorias/create" class="btn btn-success">Crear nueva categoria</a>
                        <!--<input type="text" class="form-control" id="searchCategoria" placeholder="Buscar por nombre">-->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($categorias as $categoria)
                <div name="categoria" class="col-md-4 mb-4">
                    <div name="{{$categoria->nombre}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="h2">{{$categoria->nombre}} ({{$categoria->id}})</div>
                                <div class="h4">{{$categoria->getCantidadProductos()}} productos</div>
                                <br>
                                <p><b>Creación</b>: {{$categoria->created_at}}</p>
                                <p><b>Modificación</b>: {{$categoria->updated_at}}</p>
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
                    <button id="prevButton" class="btn btn-info btn-sm mr-3">< Anterior</button>
                    <button id="nextButton" class="btn btn-info btn-sm">Siguiente ></button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3 d-flex justify-content-center">
                    <p id="mostrando">Mostrando 1 de 84 páginas</p>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script>cambiar('categorias');</script>
@endsection
