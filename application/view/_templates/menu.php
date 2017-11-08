

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-1">
      <?php require APP . 'view/_templates/buscador.php';  ?>
    </div>
  </div>

<nav class="menu">
  <ul>
    <li>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="flaticon flaticon-bloquear" aria-hidden="true"></i>&nbsp;
        Zona Privada
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu submenu" id="dropdown-zonaprivada">
        <li>
          <a href="<?php echo URL; ?>administracion/IniciarSesion">
              <i class="flaticon flaticon-ingresar-boton-de-flecha-en-esquema-de-cuadrado"></i>&nbsp;&nbsp;
            Iniciar Sesion
          </a>
        </li>
      </ul>
    <li>
      <a href="<?php echo URL ?>home/AcercaDe">
        <i class="flaticon flaticon-signos"></i>&nbsp;&nbsp;
        Acerca de
      </a>
    </li>
    <li>
      <a href="<?php echo URL ?>home/Contacto">
        <i class="flaticon flaticon-agenda"></i>&nbsp;&nbsp;
        Contacto
      </a>
    </li>
    <li>
      <a href="<?php echo URL ?>home/Index">
        <i class="flaticon flaticon-edificios"></i>&nbsp;&nbsp;
        Home
      </a>
    </li>
  </ul>
</nav>
