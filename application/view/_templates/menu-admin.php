<div class="main">
  <!-- banner -->
<div class="wthree_agile_admin_info">
		  <div class="w3_agileits_top_nav">
			<ul id="gn-menu" class="gn-menu-main">
					<li class="second logo-dashboard">
            <h1>
              <a href="<?php echo URL; ?>administracion/Index">
                <img src="<?php echo URL ?>img/logo/logo-foxWay.jpg" alt="logo" class="img-logo">&nbsp;
                Mi Tienda </a>
            </h1>
          </li>
						<li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
									<li class="dropdown head-dpdn">
										<a href="<?php echo URL; ?>administracion/Categorias">
                      <i class="fa fa-database" aria-hidden="true"></i>&nbsp;
                        Categorías
                    </a>
									</li>
						</ul>
				</li>
				<li class="dropdown head-dpdn padding second top_bell_nav top_dp_agile" id="productos">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">
						<i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;
						Productos
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="dropdown-productos">
						<li>
							<a href="<?php echo URL; ?>administracion/Registrar">
								<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
								Registro
							</a>
							<a href="<?php echo URL; ?>administracion/Listar">
								<i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;
								Listado
							</a>
						</li>
					</ul>
					<li class="second top_bell_nav">
				 <ul class="top_dp_agile ">
								<li class="dropdown head-dpdn">
									<a href="<?php echo URL; ?>marcas/Marcas">
										<i class="fa fa-medium" aria-hidden="true"></i>&nbsp;
											Marcas
									</a>
								</li>
					</ul>
			</li>
				</li>
				<li class="dropdown head-dpdn padding second top_bell_nav top_dp_agile" id="users">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">
						<i class="fa fa-users" aria-hidden="true"></i>&nbsp;
						Usuarios
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="dropdown-users">
						<li>
							<a href="<?php echo URL; ?>usuarios/RegistrarUsuarios">
								<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
								Registro
							</a>
							<a href="<?php echo URL; ?>usuarios/ListarUsuarios">
								<i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;
								Listado
							</a>
						</li>
					</ul>
				</li>

				<?php
					$ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' .  $_SESSION['USUARIO'] . ".jpg" ;

					$ext = explode('.', $ruta);
					$extension = end($ext);
				 ?>

      <li class="dropdown padding">
	      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

					<?php if (file_exists($ruta)): ?>
						<img class="profile-img" src="<?php echo URL ?>img/perfil/<?php echo $_SESSION['USUARIO'] ?>.<?php echo $extension ?>">
					<?php else: ?>
						<img class="profile-img" src="<?php echo URL ?>img/perfil/profile.jpg">
					<?php endif; ?>

	        <p><strong><?php echo $_SESSION['USUARIO']; ?></strong></p>
	         	 <strong><?php echo $_SESSION['ROL']; ?></strong>&nbsp;
	        <span class="caret"></span>
	      </a>
        <ul class="dropdown-menu">
          <li>
            <a href="<?php echo URL; ?>administracion/Perfil">
              <i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;Perfil
            </a>
            <a href="<?php echo URL; ?>administracion/ConfiguracionCuenta">
              <i class="fa fa-cog fa-spin" aria-hidden="true"></i>&nbsp;Configuración Cuenta
            </a>
             <li role="separator" class="divider"></li>
            <li>
              <a href="<?php echo URL; ?>administracion/CerrarSesion">
                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Cerrar Sesión
              </a>
            </li>
          </li>
        </ul>
      </li>
			</ul>
			<!-- //nav -->
