
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar top-title">
            <h1 class="text-center">Perfil de <?php echo $_SESSION['USUARIO'] ?></h1>
          </div>
					<div class="inner_content_w3_agile_info">
            <div class="container-profile">
					   <div class="agile_top_w3_grids">

               <?php
                 $ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' .  $_SESSION['USUARIO'] . ".jpg" ;

                 $ext = explode('.', $ruta);
                 $extension = end($ext);
                ?>

                <?php if (file_exists($ruta)): ?>
                  <center>
                    <img class="img-profile" src="<?php echo URL ?>img/perfil/<?php echo $_SESSION['USUARIO'] ?>.<?php echo $extension ?>" alt="<?php echo $_SESSION['USUARIO'] ?>">
                  </center>
                <?php else: ?>
                  <center>
                    <img class="img-profile" src="<?php echo URL ?>img/perfil/profile.jpg" alt="profile">
                  </center>
                <?php endif; ?>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-3">
                      <ul class="data-profile fuente">
                        <li>
                          <i class="fa fa-user"></i>
                          <strong>Usuario:</strong>&nbsp;<?php echo $_SESSION['USUARIO']; ?>
                        </li>
                        <?php foreach ($persona as $r): ?>
                          <li>
                            <i class="fa fa-user-secret"></i>
                            <strong>Nombre Real:</strong> <?php echo $r['nombres'] ?> <?php echo $r['apellidos'] ?>
                          </li>
                          <li>
                            <i class="fa fa-birthday-cake"></i>
                            <strong>Fecha Nacimiento:</strong> <?php echo $r['fecha_nacimiento'] ?>
                          </li>
                        <?php endforeach; ?>
                        <li>
                          <i class="fa fa-book"></i>
                          <strong>Correo Electrónico:</strong>&nbsp;<?php echo $_SESSION['EMAIL']; ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
					   </div>
				    </div>
				</div>
	    </div>
  </div>
