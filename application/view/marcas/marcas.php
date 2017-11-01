
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar  top-title">
            <h1 class="text-center">Marcas</h1>
          </div>
					<div class="inner_content_w3_agile_info">
					   <div class="agile_top_w3_grids">
               <div class="main-categories">
               <form class="form-horizontal" name="formmarcas" id="form-marcas">
                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-2">
                     <div class="form-group">
                       <label for="marca" class="control-label">Marca <span class="red">*</label>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-sm-10 col-md-8 col-md-offset-2">
                     <div class="form-group">
                       <input type="text" class="form-control" name="marca" id="marca" onkeyup="ValidarLargoMarca()">
                     </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <div class="col-sm-offset-2 col-sm-10">
                     <button type="button" class="btn btn-success btn-marca" name="btn-categoria" id="btn-marca" onclick="ValidarFormularioMarcas()">
                       <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
                       Guardar
                     </button>
                   </div>
                 </div>
               </form>

               <!-- Alert marca requerida -->
             <div class="alert alert-danger alert-dismissible ocultar" id="avisomarca" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                 <strong>Error!</strong>&nbsp;La marca es requerida
               </p>
             </div>

             <!-- Alert procesando -->
             <center class="ocultar" id="cargarmarca">
               <div class="alert alert-warning alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
                 <p class="centrar">
                   <i class="fa fa-spinner fa-spin fa-3x"></i>&nbsp;
                   Procesando...!
                 </p>
               </div>
             </center>

             <!-- Alert guardado exitoso-->
             <div class="alert alert-success alert-dismissible ocultar" id="exitomarca" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                 <strong>Enhorabuena!</strong>&nbsp;Datos guardados correctamente
               </p>
             </div>

             <!-- Alert nombre repetido -->
             <div class="alert alert-danger alert-dismissible ocultar" id="nombremarcarepetido" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                 <strong>Error!</strong>&nbsp;La marca ingresada ya existe en la base de datos
               </p>
             </div>

               <!-- Alert longitud campo -->
             <div class="alert alert-danger alert-dismissible ocultar" id="avisomarcalargo" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                 <strong>Error!</strong>&nbsp;La marca debe contener mínimo 3 caracteres
               </p>
             </div>

                 <div class="row top-table">
                   <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="dataTable_wrapper">
                       <div class="table-responsive">
                         <table class="table table-striped" id="table-categories">
                           <thead>
                             <tr>
                               <th>Id</th>
                               <th>Marca</th>
                               <th>Estado</th>
                               <th>Opciones</th>
                               <th>&nbsp;</th>
                             </tr>
                           </thead>
                           <tbody>
                           <?php foreach ($marcas as $marca): ?>
                             <tr>
                               <td><?php echo $marca['id_marca']; ?></td>
                               <td><?php echo ucwords($marca['marca']); ?></td>
                               <td><?php echo $marca['estado'] == 1 ? 'Habilitado' : 'Inhabilitado'; ?></td>
                               <td>
                                 <?php if ($marca['estado']== 1): ?>

                                 <?php if ($marca['id_marca'] == 1): ?>
                                 <?php else: ?>
                                   <button type="button" name="btn-detalles" class="btn btn-info" data-toggle="modal" data-target="#edicion" onclick="EdicionMarca('<?php echo $marca['id_marca']; ?>');">
                                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;
                                     Editar
                                   </button>
                                 <?php endif; ?>
                               <?php else: ?>
                               <?php endif; ?>
                               </td>
                               <td>
                                 <?php if ($marca['id_marca'] == 1): ?>
                                 <?php else: ?>
                                   <button type="button" name="btn-estado" class="btn btn-warning" onclick="CambiarEstadoMarca('<?php echo $marca['id_marca']; ?>');">
                                     <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;
                                     Cambiar Estado
                                   </button>
                                 <?php endif; ?>
                               </td>
                             </tr>
                           <?php endforeach; ?>
                           </tbody>
                         </table>
                       </div>

                       <!-- Alert cambio estado exitoso -->
                       <div class="alert alert-success alert-dismissible ocultar" id="cambioestadomarca" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                         <p class="centrar">
                           <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                           <strong>Enhorabuena!</strong>&nbsp;El estado fue cambiado correctamente
                       </div>

                       <!-- Alert procesando -->
                       <center class="ocultar" id="cargandoestadomarca">
                         <div class="alert alert-warning alert-dismissible" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
                           <p class="centrar">
                             <i class="fa fa-spinner fa-spin fa-3x"></i>&nbsp;
                             Procesando...!
                           </p>
                         </div>
                       </center>

                       <!-- Modal modificación marcas-->
                       <div class="modal fade" id="edicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Recargar()"><span aria-hidden="true">&times;</span></button>
                             <h5 class="modal-title modal-details-pdcts" id="myModalLabel" align="center"><strong>Edición Marcas</strong></h5>
                           </div>
                           <div class="modal-body">
                               <form name="formeditmarcas" id="form-edit-marcas">
                                 <div class="row">
                                   <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                                     <div class="form-group">
                                       <label for="marca-edicion">Categoría <span class="red obligatorio">*</span></label>
                                       <input type="text" id="marca-edicion" name="marca_edicion" class="form-control" readonly onkeyup="ValidarLargoMarcaEdicion()">
                                     </div>
                                   </div>
                                 </div>
                                 <input type="hidden" name="idmarca" id="id-marca">
                              </form>

                               <!-- Alert categoría obligatorio -->
                               <div class="alert alert-danger alert-dismissible ocultar" id="avisomarcaedicion" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                                   <strong>Error!</strong>&nbsp;Debes ingresar un nombre
                                 </p>
                               </div>

                               <!-- Alert categoría largo -->
                               <div class="alert alert-danger alert-dismissible ocultar" id="avisolargomarcaedicion" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                                   <strong>Error!</strong>&nbsp;Debes ingresar mínimo 3 caracteres
                                 </p>
                               </div>

                               <!-- Alert nombre repetido -->
                               <div class="alert alert-danger alert-dismissible ocultar" id="nombremarcarepetidoedicion" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                                   <strong>Error!</strong>&nbsp;La marca ya existe en la base de datos
                                 </p>
                               </div>

                               <!-- Alert actualización exitosa -->
                               <div class="alert alert-success alert-dismissible ocultar" id="successmarca" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                                   <strong>Enhorabuena!</strong>&nbsp;Datos actualizados correctamente
                                 </p>
                               </div>

                               <!-- Alert procesando -->
                               <center class="ocultar" id="procesandodatosmarca">
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
                             <button type="button" class="btn btn-primary" onclick="EditarDatosMarca()" id="btn-editarmarca">
                               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;
                               Editar
                             </button>
                             <button type="button" class="btn btn-success ocultar" id="btn-actualizarmarca" onclick="ValidarDatosMarca()">
                               <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
                               Actualizar
                             </button>
                             <button type="button" class="btn btn-default" data-dismiss="modal" onclick="LimpiarDatosMarca()">
                               <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                               Cerrar
                             </button>
                           </div>
                         </div>
                       </div>
                     </div>

                     </div>
                   </div>
                 </div>
               </div>
            </div>
				</div>
		  </div>
	  </div>
</div>
