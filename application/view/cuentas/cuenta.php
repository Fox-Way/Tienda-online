
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar top-title">
            <h1 class="text-center">Configuración de cuenta</h1>
          </div>
					<div class="inner_content_w3_agile_info">
            <div class="container-account">
					   <div class="agile_top_w3_grids">
               <form class="form-horizontal" name="formcuenta" enctype="multipart/form-data" id="form-cuenta">
                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-5">
                     <div class="form-group">
                       <label for="user">Usuario <span class="red">*</span></label>
                     </div>
                     <div class="form-group">
                  <?php foreach ($usuario as $user): ?>
                       <input type="text" name="user" id="user" class="form-control" onkeyup="ValidarUsuario()" value="<?php echo $user['usuario'] ?>">
                     </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                     <div class="form-group">
                       <label for="email">Correo Electrónico <span class="red">*</span></label>
                     </div>
                     <div class="form-group">
                       <input type="text" name="email_user" id="email_user" class="form-control" onkeyup="ValidarEmailUser()" value="<?php echo $user['email'] ?>">
                     </div>
                   </div>
                  <?php endforeach; ?>
                 </div>

                 <!-- Alert nombre usuario largo -->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisouser" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;Debes ingresar como mímino 4 caracteres
                   </p>
                 </div>

                 <!-- Alert correo electrónico -->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisoemailuser" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;Debes ingresar un formato válido (example@gmail.com)
                   </p>
                 </div>

                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-5">
                     <div class="form-group">
                  <?php foreach ($persona as $value): ?>
                       <label for="nacimiento">Fecha de Nacimiento</label>
                     </div>
                     <div class="input-group date nacimiento">
                       <input type="text" name="date" id="nacimiento" data-date="31-10-2017" data-date-format="dd-mm-yyyy" class="form-control" placeholder="dd-mm-yyyy" aria-describedby="basic-addon2" value="<?php echo $value['fecha_nacimiento'] ?>" readonly>
                       <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                     </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                     <div class="form-group">
                       <label for="nombres">Nombres</label>
                     </div>
                     <div class="form-group">
                       <input type="text" name="nombres" id="nombres" class="form-control" value="<?php echo $value['nombres'] ?>">
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-5">
                     <div class="form-group">
                       <label for="apellidos">Apellidos</label>
                     </div>
                     <div class="form-group ">
                       <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $value['apellidos'] ?>">
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-10">
                     <div class="media">
                      <div class="media-left">

                        <?php
                          $ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' .  $_SESSION['USUARIO'] . ".jpg" ;

                          $ext = explode('.', $ruta);
                          $extension = end($ext);
                         ?>

                         <?php if (file_exists($ruta)): ?>
                           <img class="media-object" src="<?php echo URL ?>img/perfil/<?php echo $_SESSION['USUARIO'] ?>.<?php echo $extension ?>" width="70" height="70">
                         <?php else: ?>
                           <img class="media-object" src="<?php echo URL ?>img/perfil/user.png" width="70" height="70">
                         <?php endif; ?>
                      </div>
                      <div class="media-body">
                        <label>Nueva foto de Perfil</label>
                        <input type="file" name="foto" id="foto" class="form-control" />
                      </div>
                    </div>
                   </div>
                 </div>
                  <?php endforeach; ?>
                 <br>
                 <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <button type="button" class="btn btn-success btn-cuenta" onclick="ValidarFormularioCuenta()">
                          <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
                          Guardar
                        </button>
                     </div>
                   </div>
                 </div>

                 <!-- Alert correo requerido-->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisorequerido" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;Debes llenar los campos con <span class="red">*</span> obligatoriamente
                   </p>
                 </div>

                 <!-- Alert usuario requerido-->
                 <div class="alert alert-danger alert-dismissible ocultar" id="user" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;El correo electrónico es requerido
                   </p>
                 </div>

                 <!-- Alert procesando -->
                  <center class="ocultar" id="carga">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
                      <p class="centrar">
                        <i class="fa fa-spinner fa-spin fa-3x"></i>&nbsp;
                        Procesando...!
                      </p>
                    </div>
                  </center>

                  <!-- Alert email ya existe-->
                  <div class="alert alert-danger alert-dismissible ocultar" id="emailusuariorepetido" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="centrar">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                      <strong>Error!</strong>&nbsp;El usuario y/o el correo ya existen en la base de datos
                    </p>
                  </div>

                  <!-- Alert actualización correcta-->
                  <div class="alert alert-success alert-dismissible ocultar" id="exito" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="centrar">
                      <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                      <strong>Enhorabuena!</strong>&nbsp;Los datos fuerón modificados correctamente
                    </p>
                  </div>

                  <!-- Alert error formato imágen-->
                  <div class="alert alert-danger alert-dismissible ocultar" id="errorformatoimagen" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="centrar">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                      <strong>Error!</strong>&nbsp;El formato de la imágen es inválido, solo se aceptan imágenes jpg, jpeg
                    </p>
                  </div>

                  <!-- Alert error formato fecha-->
                  <div class="alert alert-danger alert-dismissible ocultar" id="formatofecha" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="centrar">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                      <strong>Error!</strong>&nbsp;El formato de la fecha es inválido
                    </p>
                  </div>

               </form>
                </div>
					   </div>
				    </div>
				</div>
	    </div>
  </div>
