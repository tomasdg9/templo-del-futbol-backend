@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{route('productos')}}">
        @csrf

        <div class="mb-3 col" style="display: flex; justify-content: center;">
        @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
            <label for="title" class="form-label">Nombre del nuevo producto</label>
            <input type="text" class="form-control mb-2" name="title" id="exampleFormControlInput1">

            <label for="producto_id" class="form-label">Categoria del producto</label>
            
            <input type="submit" value="Crear producto" class="btn btn-primary my-2" />
        </div>
    </form>

    <div >
        @foreach ($productos as $producto)

            <div class="row py-1" style="display: flex; justify-content: center;">
                <div class="col-md-9 d-flex align-items-center">
                    <a href="{{ route('productos-edit', ['id' => $producto->id]) }}">{{ $producto->nombre }}</a>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <form action="{{ route('productos-destroy', [$producto->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
            
        @endforeach
    </div>
    </div>
</div>

@endsection