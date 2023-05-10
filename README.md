## Informe

<div align="center">
  <img src="http://imgfz.com/i/Prh8nST.jpeg" width="400" alt="Laravel Logo">
</div>

<h2 align="center">Vercel funcionando. El link será enviado a Carolina por email.</h2>

<h3 align="center">Proyecto Framework PHP - Laravel</h3>

<p align="center">
  <strong>¿Qué entidades se podrán editar?</strong>
</p>
<p align="center">
  Categoría<br>
  Producto
</p>

<p align="center">
  <strong>¿Qué reportes se podrán generar o visualizar?</strong>
</p>
<p align="center">
  Se podrán generar reportes de creación de productos, de modificación de productos, creación de categorías, de pedidos realizados por un cliente y de compras totales colocando fecha de inicio y fecha de fin. <br>
  Todos se podrán visualizar desde el panel administrativo del usuario en Laravel.
</p>

<p align="center">
  <strong>¿Qué entidades se podrán obtener por API?</strong>
</p>
<p align="center">
  Las entidades que se podrán obtener por API son los productos y las categorías.
</p>

<p align="center">
  <strong>¿Qué entidades se podrán modificar por API?</strong>
</p>
<p align="center">
  Se podrán modificar,<br>
  Producto -> Disminuye el stock en caso de comprarlo. (Esto será agregado como un extra en la etapa siguiente)<br>
  Pedido -> Cuando el usuario realice la compra del producto deseado (Esto lleva a la modificación de la entidad de abajo).<br>
  DetallePedido -> Cada vez que el usuario realice la compra del producto.
</p>

<h3 align="center">Proyecto React - JavaScript</h3>

<p align="center">
  <strong>¿Qué información podrá ver el usuario?</strong>
</p>
<p align="center">
  El usuario podrá ver los productos con sus respectivas propiedades (nombre, descripción, precio, stock, etc), las categorías para filtrar los productos, sus compras realizadas, sus datos (email, telefono, etc).
</p>

<p align="center">
  <strong>¿Qué acciones podrá realizar, ya sea la primera vez que ingrese a la aplicación como futuros accesos a la misma?</strong>
</p>
<p align="center">
  La primera vez tendrá que ingresar sus datos para quedar registrado en la página web. Luego, podrá modificarlos cuando los desee. <br>
  También, podrá comprar productos, filtrar productos por categoría, por nombre, etc.
</p>

<p align="center">
  <em>Observación: Como administrador del sistema (en este caso sería un empleado de la empresa) utilizaremos la tabla users que nos brinda Laravel.</em>
</p>

<!--
## Pasos

- clonar el repo https://github.com/iaw-2023/laravel-template y mantener como owner la organización de la materia.
## parados en el directorio del repositorio recientemente clonado, ejecutar:

- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan serve`

Con el último comando, pueden acceder a http://127.0.0.1:8000/ y ver la cáscara de la aplicación Laravel

### Requisitos

- tener [composer](https://getcomposer.org/) instalado
- tener [php](https://www.php.net/) instalado



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
-->
