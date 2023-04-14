@extends('app')

@section('content')


<section class="home-section">
    <div class="home-content">
        <div class="sales-boxes">
            <div class="recent-sales box prod">    
                <div class="sales-details prod">
                    <ul class="details">
                        <li class="topic">Nombre producto</li>
                        <li><a class="d-flex align-items-center gap-2">{{ $producto->nombre }}</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Activo</li>
                        <li><a class="d-flex align-items-center gap-2">{{ ($producto->activo) == 0 ? 'NO' : 'SI' }}</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Stock</li>
                        <li><a class="d-flex align-items-center gap-2">{{ $producto->stock }}</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topic">Descripcion</li>
                        <li><a class="d-flex align-items-center gap-2">{{ $producto->descripcion }}</p></li>
                    </ul>
                    <ul class="details">
                        <li class="topíc">Precio</li>
                        <li><a class="d-flex align-items-center gap-2">${{$producto->precio}}</a></li>
                    </ul>
                    
                    </div>
            </div>
        </div>
    </div>
</section>

@endsection