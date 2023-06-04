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
                <a href="{{ url()->route('productos.principio') }}" class="btn btn-primary">Ir al principio</a>
            </ul>
        </div>
    </div>
</nav>



<form  method="POST" action="{{route('productos.store')}}">
    @csrf

    <div class="mb-3 col">

    @error('nombre')
        <div class="alert alert-danger">El nombre ya existe o es inválido.</div>
    @enderror

    @error('precio')
        <div class="alert alert-danger">El precio es inválido.</div>
    @enderror

    @error('descripcion')
        <div class="alert alert-danger">La descripción es inválida.</div>
    @enderror

    @error('activo')
        <div class="alert alert-danger">La visibilidad es incorrecta.</div>
    @enderror

    @error('stock')
        <div class="alert alert-danger">El stock es incorrecto.</div>
    @enderror

    @error('estado')
        <div class="alert alert-danger">El estado es incorrecto.</div>
    @enderror

    @error('imagen')
        <div class="alert alert-danger">La imagen es incorrecta.</div>
    @enderror

    @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
    @endif

        <label for="exampleFormControlInput1" class="form-label">Nombre del producto (*)</label>
        <input type="text" class="form-control mb-2" name="nombre" id="exampleFormControlInput1" placeholder="Ejemplo: Botines Predator 2.0" value="{{old('nombre')}}">

        <label for="exampleFormControlInput1" class="form-label">Precio (*)</label>
        <input type="text" class="form-control mb-2" name="precio" id="exampleFormControlInput1" placeholder="Ejemplo: 49999" value="{{old('precio')}}">

        <label for="exampleFormControlInput1" name="activo" class="form-label">Visibilidad (*)</label>

        <select id="inputState" class="form-control" name="activo" value="{{old('activo')}}">
            <option value="true" selected>Si</option>
            <option value="false">No</option>
        </select>

        <label for="exampleFormControlInput1" class="form-label">Stock (*)</label>
        <input type="text" class="form-control mb-2" name="stock" id="exampleFormControlInput1" placeholder="Ejemplo: 4" value="{{old('stock')}}">

        <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
        <textarea rows="5" class="form-control mb-2" name="descripcion" id="exampleFormControlInput1" placeholder="Ejemplo: Botines con tapones para ir a trabar fuerte" value="{{old('descripcion')}}"></textarea>

        <label for="exampleFormControlInput1" class="form-label">Estado (*)</label>
        <input type="text" class="form-control mb-2" name="estado" id="exampleFormControlInput1" placeholder="Ejemplo: Nuevo" value="{{old('estado')}}">

        <label for="exampleFormControlInput1" class="form-label">Imagen (*) (La imagen para ser visible no tiene que tener problemas con derechos de autor, y solo debe ser por url)</label>
        <input type="text" class="form-control mb-2" name="imagen" id="exampleFormControlInput1" placeholder="Ejemplo: https://imgur.com/a/mXpX6Ot" value="{{old('imagen')}}">

        <label for="exampleFormControlInput1" name="categoria" class="form-label">Categoria (*)</label>

        <select id="inputState" class="form-control" name="categoria" value="{{old('categoria')}}">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">
                    {{ $categoria->nombre }}
                    </option>
                @endforeach
        </select>

        <input type="submit" value="Crear producto" class="btn btn-primary my-2" />
    </div>
</form>
@endsection

@section('scripts')
<script>cambiar('productos');</script>
@endsection
