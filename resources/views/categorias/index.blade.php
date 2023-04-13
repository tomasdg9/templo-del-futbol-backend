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
                <a href="/clientes" class="btn btn-success">Crear</a>
            </ul>
        </div>
    </div>
</nav>

        <div class="container">
            <div class="row">
                @foreach ($categorias as $categoria)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="h2">{{$categoria->nombre}}</div>
                                <div class="h4">{{$categoria->getCantidadProductos()}} productos</div>
                                <br>
                                <p><b>Creación</b>: {{$categoria->created_at}}</p>
                                <p><b>Modificación</b>: {{$categoria->updated_at}}</p>
                                <p><b>Descripción</b>: {{$categoria->descripcion}}</p>
                                <p><b>Visible</b>: {{ $categoria->visible ? 'Si' : 'No' }}</p>
                                <a type="button" class="btn btn-warning">Editar</a>
                                <a type="button" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection

@section('scripts')
<script>cambiar('categorias');</script>
@endsection
