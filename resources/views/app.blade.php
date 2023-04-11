<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Panel administrativo</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">NOMBRE TIENDA</span>
    </div>
      <ul class="nav-links">
        <li>
          <a id="dashboard" onClick="cambiar(this.id)" href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Estadisticas</span>
          </a>
        </li>
        <li>
          <a id="product" onClick="cambiar(this.id)" href="#">
            <i class='bx bx-box' ></i>
            <span class="links_name">Productos</span>
          </a>
        </li>
        <li>
          <a id="pedidos" onClick="cambiar(this.id)"href="#">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Pedidos</span>
          </a>
        </li>
        <li>
          <a id="categorias" onClick="cambiar(this.id)"href="#">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Categorias</span>
          </a>
        </li>
        <li>
          <a id="clientes" onClick="cambiar(this.id)"href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Clientes</span>
          </a>
        </li>
        <li>
          <a id="rproduct" onClick="cambiar(this.id)"href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Reportes productos</span>
          </a>
        </li>
        <li>
            <a id="rpedidos" onClick="cambiar(this.id)"href="#">
              <i class='bx bx-book-alt' ></i>
              <span class="links_name">Reportes pedidos</span>
            </a>
        </li>
        <li class="log_out">
          <a href="#">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>

    @yield('content')


</body>
</html>

