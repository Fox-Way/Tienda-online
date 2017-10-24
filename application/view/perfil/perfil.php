
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
               <center>
                 <img src="<?php echo URL ?>img/perfil/profile.jpg" alt="profile" class="img-profile">
               </center>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-3">
                      <ul class="data-profile fuente">
                        <li>
                          <i class="fa fa-user"></i>
                          <strong>Usuario:</strong>&nbsp;<?php echo $_SESSION['USUARIO']; ?>
                        </li>
                        <li>
                          <i class="fa fa-user-secret"></i>
                          <strong>Nombre Real:</strong> nombres
                        </li>
                        <li>
                          <i class="fa fa-birthday-cake"></i>
                          <strong>Fecha Nacimiento:</strong> Fecha Nacimiento
                        </li>
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
