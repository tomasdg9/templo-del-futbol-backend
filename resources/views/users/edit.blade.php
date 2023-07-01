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



<div class="card">
    <div class="card-body">
        <p class="h5"> Nombre:</p>
        <p class="form-control">{{$user->name}}</p>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @method('PUT')
            @csrf
            <h3>Listado de roles</h3>
            @foreach ($roles as $role)
                <div>
                    <label>
                        <input type="radio" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }} class="mr-1">
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach

            <button class="btn btn-primary" type="submit">Guardar</button>
        </form>

    </div>
</div>

@endsection

@section('scripts')
    <script>cambiar('staff')</script>
@endsection