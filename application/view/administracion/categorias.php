
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar  top-title">
            <h1 class="text-center">Categorías</h1>
          </div>
					<div class="inner_content_w3_agile_info">
					   <div class="agile_top_w3_grids">
               <div class="main-categories">
               <form class="form-horizontal" name="formcategories" id="form-categories">
                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-2">
                     <div class="form-group">
                       <label for="categoria" class="control-label">Categoría <span class="red">*</label>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-sm-10 col-md-8 col-md-offset-2">
                     <div class="form-group">
                       <input type="text" class="form-control" name="nombrecategoria" id="nombrecategoria" onkeypress="ValidarLargoCategoria()">
                     </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <div class="col-sm-offset-2 col-sm-12 col-md-5">
                     <button type="button" class="btn btn-success btn-categoria" name="btn-categoria" id="btn-categoria" onclick="ValidarFormularioCategoria()">
                       <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
                       Guardar
                     </button>
                     <button type="reset" class="btn btn-secondary btn-limpiar" name="btn-limpiar" id="btn-limpiar">
                       <i class="fa fa-eraser" aria-hidden="true"></i>&nbsp;
                       Borrar
                     </button>
                   </div>
                 </div>
               </form>

               <!-- Alert categoria requerido -->
             <div class="alert alert-danger alert-dismissible ocultar" id="avisonombre" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                 <strong>Error!</strong>&nbsp;La categoría es requerida
               </p>
             </div>

             <!-- Alert procesando -->
             <center class="ocultar" id="cargardatos">
               <div class="alert alert-warning alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
                 <p class="centrar">
                   <i class="fa fa-spinner fa-spin fa-3x"></i>&nbsp;
                   Procesando...!
                 </p>
               </div>
             </center>

             <!-- Alert guardado exitoso-->
             <div class="alert alert-success alert-dismissible ocultar" id="exitocategoria" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                 <strong>Enhorabuena!</strong>&nbsp;Datos guardados correctamente
               </p>
             </div>

             <!-- Alert nombre repetido -->
             <div class="alert alert-danger alert-dismissible ocultar" id="nombrecategoriarepetido" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                 <strong>Error!</strong>&nbsp;La categoría ya existe en la base de datos
               </p>
             </div>

               <!-- Alert longitud campo -->
             <div class="alert alert-danger alert-dismissible ocultar" id="avisocategorialargo" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">&times;</span>
               </button>
               <p class="centrar">
                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                 <strong>Error!</strong>&nbsp;El nombre debe contener mínimo 5 caracteres
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
                               <th>Categoría</th>
                               <th>Estado</th>
                               <th>Opciones</th>
                               <th>&nbsp;</th>
                             </tr>
                           </thead>
                           <tbody>
                           <?php foreach ($categorias as $record): ?>
                             <tr>
                               <td><?php echo $record['id']; ?></td>
                               <td><?php echo $record['nombre']; ?></td>
                               <td><?php echo $record['estado'] == 1 ? 'Habilitado' : 'Inhabilitado'; ?></td>
                               <td>
                                 <?php if ($record['estado'] == 1): ?>
                                   <button type="button" name="btn-detalles" class="btn btn-info" data-toggle="modal" data-target="#edicion" onclick="Edicion('<?php echo $record['id']; ?>');">
                                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;
                                     Editar
                                   </button>
                                 <?php else: ?>
                                 <?php endif; ?>
                               </td>
                               <td>
                                 <button type="button" name="btn-estado" class="btn btn-warning" onclick="CambiarEstado('<?php echo $record['id']; ?>');">
                                   <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;
                                   Cambiar Estado
                                 </button>
                               </td>
                             </tr>
                           <?php endforeach; ?>
                           </tbody>
                         </table>
                       </div>

                       <!-- Alert cambio estado exitoso -->
                       <div class="alert alert-success alert-dismissible ocultar" id="cambioestado" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                         <p class="centrar">
                           <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                           <strong>Enhorabuena!</strong>&nbsp;El estado fue cambiado correctamente
                       </div>

                       <!-- Alert procesando -->
                       <center class="ocultar" id="cargando">
                         <div class="alert alert-warning alert-dismissible" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
                           <p class="centrar">
                             <i class="fa fa-spinner fa-spin fa-3x"></i>&nbsp;
                             Procesando...!
                           </p>
                         </div>
                       </center>

                       <!-- Modal modificación categoría-->
                       <div class="modal fade" id="edicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Limpiar()"><span aria-hidden="true">&times;</span></button>
                             <h5 class="modal-title modal-details-pdcts" id="myModalLabel" align="center"><strong>Edición Categorías</strong></h5>
                           </div>
                           <div class="modal-body">
                               <form name="formeditproducts" id="form-edit-products">
                                 <div class="row">
                                   <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                                     <div class="form-group">
                                       <label for="categoria-edicion">Categoría <span class="red obligatorio">*</span></label>
                                       <input type="text" id="categoria-edicion" name="categoria_edicion" class="form-control" readonly onkeyup="ValidarLargoNombre()">
                                     </div>
                                   </div>
                                 </div>
                                 <input type="hidden" name="idcategoria" id="id-categoria">
                              </form>

                               <!-- Alert categoría obligatorio -->
                               <div class="alert alert-danger alert-dismissible ocultar" id="avisocateg" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                                   <strong>Error!</strong>&nbsp;Debes ingresar un nombre
                                 </p>
                               </div>

                               <!-- Alert categoría largo -->
                               <div class="alert alert-danger alert-dismissible ocultar" id="avisolargocateg" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                                   <strong>Error!</strong>&nbsp;Debes ingresar mínimo 3 caracteres
                                 </p>
                               </div>

                               <!-- Alert nombre repetido -->
                               <div class="alert alert-danger alert-dismissible ocultar" id="nombrerepetido" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                                   <strong>Error!</strong>&nbsp;La categoría ya existe en la base de datos
                                 </p>
                               </div>

                               <!-- Alert actualización exitosa -->
                               <div class="alert alert-success alert-dismissible ocultar" id="success" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                                 <p class="centrar">
                                   <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                                   <strong>Enhorabuena!</strong>&nbsp;Datos actualizados correctamente
                                 </p>
                               </div>

                               <!-- Alert procesando -->
                               <center class="ocultar" id="cargar">
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
                             <button type="button" class="btn btn-primary" onclick="EditarDatosCategoria()" id="btn-editar">
                               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;
                               Editar
                             </button>
                             <button type="button" class="btn btn-success ocultar" id="btn-actualizar" onclick="ValidarDatosCategoria()">
                               <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
                               Actualizar
                             </button>
                             <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Limpiar()">
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
