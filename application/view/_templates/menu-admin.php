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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
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
				</li>


				<!-- <li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
									<li class="dropdown head-dpdn">
										<a href="<?php echo URL; ?>administracion/Productos">
                      <i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;
                      Productos
                    </a>
									</li>
						</ul>
				</li> -->
				<li class="second top_bell_nav">
				   <ul class="top_dp_agile ">
				       <li class="dropdown head-dpdn">
										<a href="<?php echo URL; ?>administracion/Usuarios">
                      <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                      Usuarios
                    </a>
									</li>
								</ul>
				</li>

      <li class="dropdown padding">
	      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	        <img src="<?php echo URL ?>img/perfil/profile.jpg" alt="profile" class="profile-img">&nbsp;
	        <p><strong><?php echo $_SESSION['USUARIO']; ?></strong></p>
	         	 <strong><?php echo $_SESSION['ROL']; ?></strong>&nbsp;
	        <span class="caret"></span>
	      </a>
        <ul class="dropdown-menu">
          <li>
            <a href="<?php echo URL; ?>administracion/Perfil">
              <i class="fa fa-user-md" aria-hidden="true"></i>&nbsp;Perfil
            </a>
            <a href="#">
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
