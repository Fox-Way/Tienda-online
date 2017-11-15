<nav class="navbar navbar-inverse">
  <div class="container">
    <ul class="nav nav-pills margin">
      <li>
        <a href="#" class="white">
          <i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home
        </a>
      </li>
      <li>
        <a href="<?= URL ?>FacturacionCtrl/CrearFactura" class="white">
          <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Crear Factura
        </a>
      </li>
      <li class=" pull-right">
        <a href="<?= URL ?>LoginCtrl/cerrarSesion" class="white">
          <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Cerrar Sesión
        </a>
      </li>
    </ul>
  </div>
</nav>
<div class="container top">
  <div class="row">
    <div class="col-md-5 col-md-offset-4">
      <h2>Bienvenido <?= $_SESSION['user']; ?></h2>
    </div>
  </div>
</div>
