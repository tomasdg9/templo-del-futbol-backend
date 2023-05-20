<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="/img/favicon.ico">
    <title>Panel administrativo</title>

    <!-- BootStrap y estilos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/style2.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- Grafico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>El templo del Fútbol</h3>
            </div>
            <ul class="list-unstyled components">
                <p>Sesión de: @auth {{Auth::user()->name}} @endauth</p>
                <li id="estadisticas" class="active">
                    <a href="{{ route('principio') }}"><i class="fas fa-calculator"></i> Estadisticas</a>
                </li>
				 <li id="productos">
                    <a href="{{ route('productos.index') }}"><i class="fas fa-shopping-bag"></i> Productos</a>
                </li>
				 <li id="pedidos"> <!-- Esto es DetallePedidos -->
                    <a href="{{ route('pedidos.index') }}"><i class="fas fa-shopping-cart"></i> Pedidos</a>
                </li>
				 <li id="categorias">
                    <a href="{{ route('categorias.index') }}"><i class="fas fa-book"></i> Categorias</a>
                </li>
				 <li id="clientes"> <!-- Esto vendria a ser Pedidos que se mapearía como "Clientes" -->
                    <a href="{{ route('clientes.index') }}"><i class="fas fa-user"></i> Clientes</a>
                </li>
				 <li id="rproductos">
                    <a href="{{ route('rproductos.index') }}"><i class="fas fa-cog"></i> Reportes productos</a>
                </li>
				 <li id="rpedidos"> <!-- Incluye sobre DetallePedidos y los "Clientes" -->
                    <a href="{{ route('rpedidos.index') }}"><i class="fas fa-cog"></i> Reportes pedidos</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> Desconectarse</button>
                    </form>
                </li>
            </ul>
        </nav>
        <div id="content">
            @yield('content')
            <script src="{{ asset('js/script.js') }}"></script>
            @yield('scripts')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>
</html>

</html>
