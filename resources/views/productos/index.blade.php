@extends('app')

@section('content')
<section class="home-section">
    <nav>
        <div class="sidebar-button">
          <i id="btnsidebar" class='bx bx-menu sidebarBtn'></i>
          <span class="dashboard">Productos</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Buscar producto por nombre...">
          <i class='bx bx-search' ></i>
        </div>
    </nav>


    <div class="home-content">
        <div class="sales-boxes">
            <div class="recent-sales box">
                Selecciona un producto para ver su estado
                    <div class="sales-details">

                        <ul class="details">
                            <li class="topic">Nombre producto</li>
                            @foreach ($productos as $producto)
                            <li><a class="d-flex align-items-center gap-2">
                                                {{ $producto->nombre }}</a></li>
                            @endforeach
                        </ul>

                        <ul class="details">
                            <li class="topic"><br></li>
                            @foreach ($productos as $producto) 
                            <li><a class="d-flex align-items-center gap-2" style="color:blue" href="{{route('productos.show', ['producto' => $producto ->id])}}">
                            <u>editar</u>
                            </a></li>
                            @endforeach
                        </ul>


                        <ul class="details">
                            <li class="topic">Stock</li>
                            @foreach ($productos as $producto) 
                            <li><a class="d-flex align-items-center gap-2">
                                                {{ $producto->stock }}</a></li>
                            @endforeach
                        </ul>

                        <ul class="details">
                            <li class="topic">Visible</li>
                            @foreach ($productos as $producto) 
                            <li><a class="d-flex align-items-center gap-2">
                                                {{ ($producto->activo) == 0 ? 'NO' : 'SI'}}</a></li>
                            @endforeach
                        </ul>

                        <ul class="details">
                            <li class="topic">Precio</li>
                            @foreach ($productos as $producto) 
                            <li><a class="d-flex align-items-center gap-2">
                                                {{ $producto->precio }}</a></li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn btn-primary">
</button>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection