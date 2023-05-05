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
@error('nombre')
            <div class="alert alert-danger">El nombre no es correcto.</div>
@enderror

@error('descripcion')
    <div class="alert alert-danger">La descripción no es correcta.</div>
@enderror

 @error('visible')
    <div class="alert alert-danger">La visibilidad no es correcta.</div>
@enderror
@if (session('success'))
    <h6 class="alert alert-success">{{ session('success') }}</h6>
@endif
<h2>Estadisticas sobre la categoria {{$categoria->nombre}}</h2>
<p><b>Descripción:</b> {{$categoria->descripcion}}</p>
<p><b>Visible?</b>
    @if ($categoria->visible == true)
      Si
    @else
      No
    @endif
</p>
<p>Tiene una cantidad de <b>{{$categoria->getCantidadProductos()}}</b> producto(s) asociado(s).</p>
<p><b>Creada</b>: {{$categoria->created_at}}</p>
<p><b>Última modificación</b>: {{$categoria->updated_at}}</p>
<br><p>Productos asociados:</p>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID del producto</th>
        <th scope="col">Nombre</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($categoria->productos as $producto)
            <tr>
                <th scope="row"><a href="/productos/{{$producto->id}}">{{$producto->id}}</a></th>
                <td>{{$producto->nombre}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
<br><p>Para editar esta categoria, rellene el siguiente formulario y luego, presione el botón "<b>Modificar categoria</b>"<p>
<button id="botonFormulario" onClick="cambiarNombre('botonFormulario', 'Mostrar', 'Esconder')" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formulario">Mostrar</button>
<div id="formulario" class="collapse">
    <form  method="POST" action="{{route('categorias.update',['categoria' => $categoria->id])}}">
        @method('PATCH')
        @csrf
        <div class="mb-3 col">
            <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría (*)</label>
            <input type="text" class="form-control mb-2" name="nombre" id="exampleFormControlInput1" value="{{ old('nombre', $categoria->nombre) }}">
            <label for="exampleFormControlInput1" class="form-label">Descripción (*)</label>
            <textarea rows="5" class="form-control mb-2" name="descripcion" id="exampleFormControlInput1"">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            <label for="exampleFormControlInput1" class="form-label">Visible? (*)</label>
            <select id="inputState" class="form-control" name="visible">
                @if(old('visible') == null)
                  @if($categoria->visible)
                    <option value="true" selected>Si</option>
                    <option value="false">No</option>
                  @else
                    <option value="true">Si</option>
                    <option value="false" selected>No</option>
                  @endif
                @else
                  @if(old('visible'))
                    <option value="true" selected>Si</option>
                    <option value="false">No</option>
                  @else
                    <option value="true">Si</option>
                    <option value="false" selected>No</option>
                  @endif
                @endif
              </select>
            <input type="submit" value="Modificar categoria" class="btn btn-primary my-2" />
        </div>
    </form>
    <br><br>
    <form action="{{ route('categorias.destroy', [$categoria->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger btn-sm">Eliminar categoria</button>
    </form>
    </div>
@endsection
@section('scripts')
<script>cambiar('categorias');</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Script para que se esconda el div del formulario -->
@endsection
