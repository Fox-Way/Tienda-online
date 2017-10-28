
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar top-title">
            <h1 class="text-center">Listado</h1>
          </div>
					<div class="inner_content_w3_agile_info">
					   <div class="agile_top_w3_grids">
               <div class="table-responsive">
               <div class="main-products-list">
                   <div class="row top-table">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="dataTable_wrapper">
                           <table class="table table-striped" id="table-productos">
                             <thead>
                               <tr>
                                 <th>Imágen</th>
                                 <th>Nombre</th>
                                 <th>Opciones</th>
                                 <th>&nbsp;</th>
                                 <th>&nbsp;</th>
                                 <th>&nbsp;</th>
                               </tr>
                             </thead>
                             <tbody>
                             <?php foreach ($productos as $producto): ?>
                               <tr>
                                   <td>
                                     <center>
                                       <img width="80" src="<?php echo URL ?>img/images-productos/<?php echo $producto['imagen'] != 0 ? $producto['imagen'] : 'no-disponible.jpg' ?>" alt="<?php echo $producto['imagen'] ?>">
                                     </center>
                                   </td>
                                 <td><?php echo $producto['nombre']; ?></td>
                                 <td>
                                   <button type="button" name="btn-detalles" class="btn btn-info" data-toggle="modal" data-target="#detalles" onclick="Ventana('<?php echo $producto['id']; ?>');">
                                     <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;
                                     Detalles Producto
                                   </button>
                                 </td>
                                 <td>
                                   <button type="button" name="btn-eliminar" class="btn btn-danger" onclick="EliminarProducto('<?php echo $producto['id']; ?>')">
                                     <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                     Eliminar Producto
                                   </button>
                                 </td>
                                 <form>
                                  <td>
                                      <input type="radio" onclick="Enchufe('<?php echo $producto['id']; ?>')" name="<?php echo $producto['id'] ?>" value="activado" <?php if($producto['inicio'] == 1)  echo "checked"?>>&nbsp;On
                                  </td>
                                  <td>
                                      <input type="radio" onclick="Enchufe('<?php echo $producto['id']; ?>')" name="<?php echo $producto['id'] ?>" value="desactivado" <?php if($producto['inicio'] == 0)  echo "checked"?>>&nbsp;Off
                                  </td>
                              </form>
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

                         <!-- Alert producto desactivado -->
                         <div class="alert alert-success alert-dismissible ocultar" id="desactivado" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                           <p class="centrar">
                             <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                             <strong>Enhorabuena</strong> El producto fue desactivado correctamente
                           </p>
                         </div>

                         <!-- Alert producto activado -->
                         <div class="alert alert-success alert-dismissible ocultar" id="activado" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                           <p class="centrar">
                             <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                             <strong>Enhorabuena</strong> El producto fue activado correctamente
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Recargar()"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title modal-details-pdcts" id="myModalLabel" align="center"><strong>Información del Producto</strong></h5>
          </div>
          <div class="modal-body">
              <form name="formdetailsproducts" id="form-details-products" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                      <label for="nombre">Nombre <span class="red obligatorio">*</span></label>
                      <input type="text" id="nombre" name="nombre" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                    <div class="form-group">
                      <label for="precio">Precio <span class="red obligatorio">*</span></label>
                      <input type="number" min="0" id="precio" name="precio" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                      <label for="dcto">Descuento (%) <span class="red obligatorio">*</span></label>
                      <input type="number" max="100" min="0" id="dcto" name="dcto" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                    <div class="form-group">
                      <label for="categoria">Categoría</label>
                      <input type="text" id="categoria" class="form-control" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="" id="imagen1"></div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                    <div class="" id="imagen2"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="" id="imagen3"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="descripcion">Descripción <span class="red obligatorio">*</span></label>
                      <textarea name="descripcion" rows="3" id="descripcion" name="descripcion" class="form-control" readonly></textarea>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="idproducto" id="id-producto">
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
              <div class="alert alert-danger alert-dismissible ocultar" id="nombre_productorepetido" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <p class="centrar">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                  <strong>Error!</strong>&nbsp;El nombre ya existe en la base de datos
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

              <!-- Alert formato imagen inválido -->
              <div class="alert alert-danger alert-dismissible ocultar" id="errorimagen" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <p class="centrar">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                  <strong>Error!</strong>&nbsp;
                  La extensión de la imágen es inválida o el tamaño sobrepasa el permitido
                </p>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="EditarDatos()" id="btn-editar">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;
              Editar
            </button>
            <button type="button" class="btn btn-success ocultar" id="btn-actualizar" onclick="ValidarDatos()">
              <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
              Actualizar
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Recargar()">
              <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

	  </div>
</div>
