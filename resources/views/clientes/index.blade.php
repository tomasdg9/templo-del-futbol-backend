@extends('app')

@section('content')
<section class="home-section">

    <nav>
        <div class="sidebar-button">
          <i id="btnsidebar" class='bx bx-menu sidebarBtn'></i>
          <span class="dashboard">Clientes</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Buscar cliente por email...">
          <i class='bx bx-search' ></i>
        </div>
    </nav>


    <div class="home-content">
        <div class="sales-boxes">
            <div class="recent-sales box">
                Selecciona un cliente para ver sus pedidos
                    <div class="sales-details">

                        <ul class="details">
                            <li class="topic">Email</li>
                            @foreach ($clientes as $cliente)
                            <li><a class="d-flex align-items-center gap-2" href="{{ route('clientes.show', ['cliente' => $cliente->id]) }}">
                                                {{ $cliente->email }}</a></li>
                            @endforeach
                        </ul>
                        <ul class="details">
                            <li class="topic">Pedidos realizados</li>
                            @foreach ($clientes as $cliente) <!-- Misma complejidad -> O(2n) = O(n) -->
                            <li><a class="d-flex align-items-center gap-2" href="{{ route('clientes.show', ['cliente' => $cliente->id]) }}">
                                                {{ $counts[$cliente->email] }}</a></li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
