@extends('app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top sticky-top">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Esconder</span>
        </button>
        <div class="align-items-right mr-1">Hola</div>
    </div>
</nav>

<div class="row">
        <!-- Producto más vendido-->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                PRODUCTO MÁS VENDIDO</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$productoMasVendido->nombre}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ganancias totales -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                GANANCIAS TOTALES</div>
                                <?php
                                $gananciasTotalesFormateadas = number_format($gananciasTotales, 2, ',', '.');
                                ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{$gananciasTotalesFormateadas}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ganancias de último mes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                GANANCIAS ULT. MES</div>
                                <?php
                                $gananciasUltimoMesFormateadas = number_format($gananciasUltimoMes, 2, ',', '.');
                                ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{$gananciasUltimoMesFormateadas}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cliente más frecuente -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                CLIENTE FRECUENTE</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$clienteMasCompras->email}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-8 mx-auto">
    <canvas id="grafico">
            <script>
                var fecha = new Date();
                var meses = [];
                var mesActual = fecha.getMonth()+1;
                for(i = 12; i > 0; i--){
                    if(mesActual - 1 === 0) {
                        mesActual = 12;
                    }
                    else mesActual--;
                    meses[i] = getMonthName(mesActual-1);
                }
                var ctx = document.getElementById('grafico').getContext('2d');
                var grafico = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: [meses[12], meses[11],meses[10],meses[9],meses[8],meses[7],meses[6],meses[5],meses[4],meses[3],meses[2],meses[1]],
                    datasets: [{
                      label: 'Ventas (últimos 12 meses)',
                      data: [{{$gananciasAnio[12]}}, {{$gananciasAnio[11]}}, {{$gananciasAnio[10]}}, {{$gananciasAnio[9]}}, {{$gananciasAnio[8]}}, {{$gananciasAnio[7]}}, {{$gananciasAnio[6]}}, {{$gananciasAnio[5]}}, {{$gananciasAnio[4]}}, {{$gananciasAnio[3]}}, {{$gananciasAnio[2]}}, {{$gananciasAnio[1]}}],
                      backgroundColor: '#3e95cd'
                    }]
                  },
                  options: {
                    legend: { display: false },
                    title: {
                      display: true,
                      text: 'Ventas por mes'
                    }
                  }
                });
                function getMonthName(month) {
                    var months = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                        'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];
                return months[month];
                }
            </script>
    </canvas>
</div>

<!-- Content Row -->
<div class="row mt-3">
    <!-- Content Column -->
    <div class="col-lg-6 mb-4">
        <!-- Color System -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                        Cantidad de productos
                        <div class="text-white-50 small"> {{$cantProductos}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        Cantidad de clientes
                        <div class="text-white-50 small"> {{$cantClientes}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                        Cantidad de pedidos
                        <div class="text-white-50 small"> {{$cantPedidos}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                        Cantidad de categorias
                        <div class="text-white-50 small"> {{$cantCategorias}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Información sobre el último pedido</h6>
            </div>
            <div class="card-body">
                <p>ID: {{$ultimoPedido->id}}</p>
                <p>Email: {{$ultimoPedido->email}}</p>
                <p>Fecha: {{$ultimoPedido->created_at}}</p>
                <p>Cantidad de productos: {{$ultimoPedido->getCantidadProductos()}}</p>
                <div class="col-md-12 d-flex justify-content-center">
                    <a type="button" class="btn btn-warning">Ver detalles</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
