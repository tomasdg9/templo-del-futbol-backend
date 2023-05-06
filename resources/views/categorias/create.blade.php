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
                <a href="{{ url()->route('categorias.index') }}" class="btn btn-primary">Volver</a>
            </ul>
        </div>
    </div>
</nav>

<form  method="POST" action="{{route('categorias.store')}}">
    @csrf
    <div class="mb-3 col">
        @error('nombre')
            <div class="alert alert-danger">El nombre ya existe o es inválido.</div>
        @enderror

        @error('descripcion')
            <div class="alert alert-danger">La descripción es inválida.</div>
        @enderror

        @error('visible')
            <div class="alert alert-danger">La visibilidad es incorrecta.</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

        <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría (*)</label>
        <input type="text" class="form-control mb-2" name="nombre" id="exampleFormControlInput1" placeholder="Ejemplo: Remeras deportivas" value="{{old('nombre')}}">

        <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
        <textarea rows="5" class="form-control mb-2" name="descripcion" id="exampleFormControlInput1" placeholder="Ejemplo: Remera ideales para el entrenamiento de cualquier deporte. Tela Dri-Fit inspirada en Nike" value="{{old('descripcion')}}"></textarea>

        <label for="exampleFormControlInput1" class="form-label">Visibilidad (*)</label>

        <select id="inputState" class="form-control" name="visible">
            <option value="true" {{ old('visible') == 'true' ? 'selected' : '' }}>Si</option>
            <option value="false" {{ old('visible') == 'false' ? 'selected' : '' }}>No</option>
        </select>
        
        <input type="submit" value="Crear categoria" class="btn btn-primary my-2" />
    </div>
</form>
@endsection

@section('scripts')
<script>cambiar('categorias');</script>
@endsection
