
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar top-title">
            <h1 class="text-center">Listado de Usuarios</h1>
          </div>
					<div class="inner_content_w3_agile_info">
					   <div class="agile_top_w3_grids">
               <div class="table-responsive">
               <div class="main-users-list">
                   <div class="row top-table">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="dataTable_wrapper">
                           <table class="table table-striped" id="table-productos">
                             <thead>
                               <tr>
                                 <th>Nombres</th>
                                 <th>Apellidos</th>
                                 <th>Correo</th>
                                 <th>Opciones</th>
                                 <th>&nbsp;</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php foreach ($usuarios as $usuario): ?>
                               <tr>
                                 <td><?php echo ucwords($usuario['nombres']); ?></td>
                                 <td><?php echo ucwords($usuario['apellidos']); ?></td>
                                   <td><?php echo $usuario['email']; ?></td>
                                 <td>
                                   <?php if ($usuario['estado'] == 1): ?>
                                     <button type="button" name="btn-detalles" class="btn btn-info" data-toggle="modal" data-target="#detalles" onclick="DetallesUsuario('<?php echo $usuario['id']; ?>');">
                                       <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;
                                       Detalles Usuario
                                     </button>
                                   <?php else: ?>
                                   <?php endif; ?>
                                 </td>
                                 <td>
                                   <button type="button" name="btn-eliminar" class="btn btn-warning" onclick="CambiarEstadoUsuario('<?php echo $usuario['id']; ?>')">
                                     <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;
                                     Cambiar Estado
                                   </button>
                                 </td>
                               </tr>
                             <?php endforeach; ?>
                             </tbody>
                           </table>
                         </div>

                         <!-- Alert procesando -->
                         <div class="alert alert-warning alert-dismissible ocultar" id="procesando" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                           <p class="centrar">
                             <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>&nbsp;
                             <strong>Procesando...!</strong>
                           </p>
                         </div>

                         <!-- Alert procesando -->
                         <div class="alert alert-warning alert-dismissible ocultar" id="cargandouser" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                           <p class="centrar">
                             <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>&nbsp;
                             <strong>Procesando...!</strong>
                           </p>
                         </div>

                         <!-- Alert procesando -->
                         <div class="alert alert-success alert-dismissible ocultar" id="cambioestadouser" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                           <p class="centrar">
                             <i class="fa fa-check fa-3x" aria-hidden="true"></i>&nbsp;
                             <strong>Enhorabuena!</strong> El estado fue cambiado correctamente
                           </p>
                         </div>

                       </div>
                     </div>
                 </div>
               </div>
            </div>
				</div>
		  </div>

      <!-- Modal detalles producto -->
      <div class="modal fade" id="detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"onclick="RecargarUser()"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title modal-details-pdcts" id="myModalLabel" align="center"><strong><span id="title-user">Información del Usuario<span></strong></h5>
          </div>
          <div class="modal-body">
              <form name="formdetailsusers" id="form-details-users">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                      <label for="nombres">Nombres</label>
                      <input type="text" id="nombres" name="nombres" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                    <div class="form-group">
                      <label for="apellidos">Apellidos</label>
                      <input type="text"  id="apellidos" name="apellidos" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                      <label for="fecha_details">Fecha Nacimiento</label>
                      <div class="input-group fecha_details fecha_nacimiento_details">
                        <input type="text" name="fecha_details" id="fecha_details" data-date="31-10-2017" data-date-format="dd-mm-yyyy" class="form-control" placeholder="dd-mm-yyyy" aria-describedby="basic-addon2" readonly>
                        <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                    <div class="form-group">
                      <label for="name_user">Nombre de usuario  <span class="red obligatorio">*</span></label>
                      <input type="text" id="name_user" class="form-control" name="name_user" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                      <label for="email_details">Correo Electrónico  <span class="red obligatorio">*</span></label>
                      <input type="text" id="email_details" name="email_details" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                    <div class="form-group">
                      <label for="rol_details">Rol</label>
                      <input type="text" id="rol_details" name="rol_details" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="iduser" id="id-user">
              </form>

              <!-- Alert campos obligatorios -->
              <div class="alert alert-danger alert-dismissible ocultar" id="avisocampos" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <p class="centrar">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                  <strong>Error!</strong>&nbsp;Debes llenar los campos con <span class="red">*</span> obligatoriamente
                </p>
              </div>

              <!-- Alert nombre repetido -->
              <div class="alert alert-danger alert-dismissible ocultar" id="user_email_repetido" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <p class="centrar">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                  <strong>Error!</strong>&nbsp;El nombre de usuario y/o el correo ya existen   en la base de datos
                </p>
              </div>

              <!-- Alert actualización exitosa -->
              <div class="alert alert-success alert-dismissible ocultar" id="exito" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <p class="centrar">
                  <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                  <strong>Enhorabuena!</strong>&nbsp;Datos actualizados correctamente
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

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="EditarDatosUser()" id="btn-editar-user">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;
              Editar
            </button>
            <button type="button" class="btn btn-success ocultar" id="btn-actualizar-user" onclick="ValidarDatosUser()">
              <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
              Actualizar
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="RecargarUser()">
              <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

	  </div>
</div>
