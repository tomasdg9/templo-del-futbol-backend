@extends('app')

@section('content')


<section class="home-section">
    <div class="home-content">
        <div class="sales-boxes">
            <div class="recent-sales box">    
                <div class="sales-details">
                    <ul class="details">
                        <li class="topic">Nombre producto</li>
                        <li><a class="d-flex align-items-center gap-2">{{ $producto->nombre }}</a></li>
                    </ul>
                    <ul class="details">
                        <li class="topíc">Activo</li>
                        <li><a class="d-flex align-items-center gap-2">{{ ($producto->activo) == 0 ? 'NO' : 'SI' }}</a></li>
                    </ul>
                    </div>
            </div>
        </div>
    </div>
</section>

@endsection