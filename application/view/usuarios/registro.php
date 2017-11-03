
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar top-title">
            <h1 class="text-center">Registro de Usuarios</h1>
          </div>
					<div class="inner_content_w3_agile_info">
					   <div class="agile_top_w3_grids">
               <div class="main-users">
                 <form class="form-horizontal" name="formusuarios" enctype="multipart/form-data" id="form-usuarios">
                   <div class="row">
                     <div class="col-xs-12 col-sm-12 col-md-3">
                       <div class="form-group">
                         <label for="nombre_persona" class="control-label">Nombres</label>
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control" name="nombre_persona" id="nombre_persona" onkeyup="ValidarLargoNombre()">
                       </div>
                     </div>
                     <br>
                     <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-1">
                       <div class="form-group">
                         <label for="corre" class="control-label">Apellidos</label>
                       </div>
                       <div class="form-group">
                         <input type="text" class="form-control" name="apellidos_persona" id="apellidos_persona" onkeyup="ValidarLargoApellido()">
                       </div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-1">
                       <div class="form-group">
                         <label for="fecha" class="control-label">Fecha Nacimiento</label>
                       </div>
                       <div class="input-group fecha fecha_nacimiento">
                         <input type="text" name="fecha" id="fecha" data-date="31-10-2017" data-date-format="dd-mm-yyyy" class="form-control" placeholder="dd-mm-yyyy" aria-describedby="basic-addon2" readonly>
                         <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                       </div>
                     </div>
                   </div>

                   <!-- Alert longitud nombre -->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisolargolargo" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;El nombre debe contener mínimo 3 caracteres
                   </p>
                 </div>

                   <!-- Alert longitud apellido-->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisolargoapellido" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;El apellido debe contener mínimo 3 caracteres
                   </p>
                 </div>

                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-3">
                     <div class="form-group">
                       <label for="nombre_usuario">Nombre de usuario <span class="red">*</span></label>
                     </div>
                     <div class="form-group">
                        <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" onkeyup="ValidarNombreUsuarioLargo()">
                     </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-1">
                     <div class="form-group">
                       <label for="correo_user">Correo Electrónico <span class="red">*</span></label>
                     </div>
                     <div class="form-group">
                       <input type="text" class="form-control" name="correo_user" id="correp_usuario" onkeyup="validarCorreoUsuario()">
                     </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-1">
                     <div class="form-group">
                       <label for="rol">Rol <span class="red">*</span></label>
                     </div>
                     <div class="form-group">
                       <select class="form-control" name="rol" id="rol">
                         <option value="">-----</option>
                         <?php foreach ($roles as $rol): ?>
                             <option value="<?php echo $rol['id_rol'] ?>"><?php echo $rol['nombre'] ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                   </div>
                 </div>

                 <!-- Alert nombre usuario requerido -->
               <div class="alert alert-danger alert-dismissible ocultar" id="avisonombreusuario" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                   <span aria-hidden="true">&times;</span>
                 </button>
                 <p class="centrar">
                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                   <strong>Error!</strong>&nbsp;El nombre de usuario es requerido
                 </p>
               </div>

               <!-- Alert correo requerido -->
             <div class="alert alert-danger alert-dismissible ocultar" id="avisocorreousuario" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                 <strong>Error!</strong>&nbsp;El correo es requerido
               </p>
             </div>

             <!-- Alert rol requerido -->
           <div class="alert alert-danger alert-dismissible ocultar" id="avisorol" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="close">
               <span aria-hidden="true">&times;</span>
             </button>
             <p class="centrar">
               <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
               <strong>Error!</strong>&nbsp;El rol es requerido
             </p>
           </div>

           <!-- Alert largo nombre usuario -->
         <div class="alert alert-danger alert-dismissible ocultar" id="avisolargo" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="close">
             <span aria-hidden="true">&times;</span>
           </button>
           <p class="centrar">
             <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
             <strong>Error!</strong>&nbsp;El nombre de usuario debe contener mínimo 3 caracteres
           </p>
         </div>

         <div class="alert alert-danger alert-dismissible ocultar" id="avisomailformato" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="close">
             <span aria-hidden="true">&times;</span>
           </button>
           <p class="centrar">
             <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
             <strong>Error!</strong>&nbsp;El formato del email es inválido (example@gmail.com)
           </p>
         </div>

         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-3">
             <div class="form-group">
               <label for="pass">Contraseña <span class="red">*</span></label>
             </div>
             <div class="form-group">
              <input type="password" name="pass" id="pass" onblur="validarPassword()" class="form-control">
             </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-1">
             <div class="form-group">
               <label for="repeat_pass">Repetir Contraseña <span class="red">*</span></label>
             </div>
             <div class="form-group">
              <input type="password" name="repeat_pass" id="repeat_pass" class="form-control" onkeyup="ValidarRepeatPassword()">
             </div>
           </div>
         </div>

         <!-- Alert password requerido-->
         <div class="alert alert-danger alert-dismissible ocultar" id="avisopasword" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="close">
             <span aria-hidden="true">&times;</span>
           </button>
           <p class="centrar">
             <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
             <strong>Error!</strong>&nbsp;La contraseña es requerida
           </p>
         </div>

         <!-- Alert repetir contraseña requerido-->
         <div class="alert alert-danger alert-dismissible ocultar" id="avisopass2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="close">
             <span aria-hidden="true">&times;</span>
           </button>
           <p class="centrar">
             <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
             <strong>Error!</strong>&nbsp;El campo repetir contraseña es requerido
           </p>
         </div>

         <!-- Alert validación contraseña -->
      <div class="alert alert-danger alert-dismissible ocultar" id="avisopassword" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
        <p class="centrar">
          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
          <strong>Error!</strong>&nbsp;La contraseña no puede tener espacios en blanco y debe tener como mínimo 8 caracteres y un número
        </p>
      </div>


     <!-- Alert validación contraseña -->
  <div class="alert alert-danger alert-dismissible ocultar" id="avisopasswordrepeat" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true">&times;</span>
    </button>
    <p class="centrar">
      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
      <strong>Error!</strong>&nbsp;Las contraseñas no coinciden
    </p>
  </div>

     <div class="row">
       <div class="col-sm-12">
         <div class="form-group">
           <button type="button" name="button" class="btn btn-info" onclick="AdjuntarImagen()">
             <i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;
             Adjuntar Imágen para Perfil
           </button>
         </div>
       </div>
     </div>

     <div class="row">
       <div class="adjuntarimagenusuario ocultar" id="adjuntarimagenusuario">
         <div class="images">
           <div class="col-xs-12 col-sm-12 col-md-5">
             <div class="form-group">
               <label for="exampleInputFile">Imágen</label>
               <input type="file" name="image_perfil" onchange="ValidarImagenPerfil()">
             </div>
           </div>
         </div>
       </div>
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

      <!-- Alert guardado exitoso -->
      <div class="container-prod ocultar" id="exito">
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
          <p class="centrar">
            <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
            <strong>Enhorabuena!</strong>&nbsp; El producto fue guardado correctamente
          </p>
        </div>
      </div>

      <!-- Alert nombre repetido -->
      <div class="container-prod ocultar" id="nombre_productorepetido">
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
          <p class="centrar">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
            <strong>Error!</strong>&nbsp; El producto ya existe en la base de datos
          </p>
        </div>
      </div>

      <!-- Alert extensión imágen inválido -->
    <div class="container-prod ocultar" id="errorimagen">
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
        <p class="centrar">
          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
          <strong>Error!</strong>&nbsp;
          La extensión de la imágen es inválida o el tamaño sobrepasa el permitido
        </p>
      </div>
    </div>

                 <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <button type="button" class="btn btn-success btn-usuario" onclick="ValidarFormularioUsuarios()">
                          <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
                          Guardar
                        </button>
                     </div>
                   </div>
                 </div>
                 </form>
               </div>
            </div>
				</div>
		  </div>
	  </div>
</div>
