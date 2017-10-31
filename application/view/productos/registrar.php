
    <?php require APP . 'view/_templates/menu-admin.php';  ?>
		</div>
		<div class="clearfix"></div>
				<div class="inner_content">
          <div class="title-bar top-title">
            <h1 class="text-center">Registro</h1>
          </div>
					<div class="inner_content_w3_agile_info">
					   <div class="agile_top_w3_grids">
               <div class="main-products">
                 <form class="form-horizontal" name="formproductos" enctype="multipart/form-data" id="form-productos">
                   <div class="row">
                     <div class="col-xs-12 col-sm-12 col-md-3">
                       <div class="form-group">
                         <label for="nombre_producto" class="control-label">Nombre Producto <span class="red">*</span></label>
                       </div>
                       <div class="form-group">
                          <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" onkeyup="ValidarNombre()">
                       </div>
                     </div>
                     <br>
                     <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-1">
                       <div class="form-group">
                         <label for="nombre_producto" class="control-label">Precio <span class="red">*</span></label>
                       </div>
                       <div class="form-group">
                         <input type="number" min="0" class="form-control" name="precio" id="precio" onkeyup="ValidarPrecio()">
                       </div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-1">
                       <div class="form-group">
                         <label for="nombre_producto" class="control-label">Descuento</label>
                       </div>
                       <div class="form-group">
                         <input type="number" min="0" placeholder="Ingrese un porcentage" max="100" class="form-control" name="dcto" id="dcto" value="0" onkeyup="ValidarDescuento()">
                       </div>
                     </div>
                   </div>


                    <!-- Alert descuento -->
                  <div class="alert alert-danger alert-dismissible ocultar" id="avisodescuento" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="centrar">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                      <strong>Error!</strong>&nbsp;El valor del descuento no puede ser mayor a 100
                    </p>
                  </div>

                   <!-- Alert longitud nombre -->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisonombrelargo" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;El nombre debe contener mínimo 5 caracteres
                   </p>
                 </div>

                 <!-- Alert nombre requerido-->
               <div class="alert alert-danger alert-dismissible ocultar" id="avisonombre" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="close">
                   <span aria-hidden="true">&times;</span>
                 </button>
                 <p class="centrar">
                   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                   <strong>Error!</strong>&nbsp;El nombre es requerido
                 </p>
               </div>

                   <!-- Alert precio requerido-->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisoprecio" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;El precio es requerido
                   </p>
                 </div>

                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-5">
                     <div class="form-group">
                       <label for="descripcion">Descripción</label>
                     </div>
                     <div class="form-group">
                        <textarea class="form-control" rows="5" name="descripcion" id="descripcion"></textarea>
                     </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                     <div class="form-group">
                       <label for="categoría">Categoría <span class="red">*</span></label>
                     </div>
                     <div class="form-group">
                       <select class="form-control" name="categoria" onchange="ValidarCategoria()">
                         <option value="">-----</option>
                         <?php foreach ($categorias as $record): ?>
                           <option value="<?php echo $record['id']; ?>"><?php echo $record['nombre']; ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                   </div>
                 </div>

                 <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-5">
                     <div class="form-group">
                       <label for="marca">Marca <span class="red">*</span></label>
                     </div>
                     <div class="form-group">
                       <select class="form-control" name="marca" onchange="ValidarMarca()">
                         <option value="">-----</option>
                         <?php foreach ($marcas as $marca): ?>
                           <option value="<?php echo $marca['id_marca']; ?>"><?php echo $marca['marca']; ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                   </div>
                 </div>

                 <!-- Alert categoría requerido-->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisocategoria" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;La categoría es requerida
                   </p>
                 </div>

                 <!-- Alert marca requerido-->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisomarca" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;La marca es requerida
                   </p>
                 </div>

                 <div class="row">
                   <div class="col-sm-12">
                     <div class="form-group">
                       <label>Color Producto <span class="red">*</span></label>
                       <button type="button" name="button" class="btn btn-warning" onclick="mostrarCamposColores()">
                         <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                       </button>
                     </div>
                   </div>
                 </div>

                 <div class="row">
                   <div class="adjuntarimagenes" id="colores">
                     <div class="images">
                       <div class="col-xs-12 col-sm-12 col-md-5">
                         <div class="form-group">
                           <label for="exampleInputFile">Color</label>
                           <select class="form-control" id="optcolores" name="optcolores" onchange="ValidarColor()">
                             <option value="">-----</option>
                             <?php foreach ($colores as $color): ?>
                               <option value="<?php echo $color['id_color']; ?>" style="background-color: <?php echo $color['codigo_color']; ?>">
                                 <strong><?php echo $color['color']; ?></strong>
                               </option>
                             <?php endforeach; ?>
                           </select>
                         </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-2">
                         <div class="form-group">
                           <label for="exampleInputFile">Cantidad <span class="red">*</span></label>
                           <input type="number" min="0" name="cantidadcolor" class="form-control" onkeyup="ValidarCantidadColor()">
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>

                 <!-- Alert color requerido -->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisocolores" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;Debe seleccionar un color
                   </p>
                 </div>

                 <!-- Alert cantidad color requerido -->
                 <div class="alert alert-danger alert-dismissible ocultar" id="avisocantcolor" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <p class="centrar">
                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                     <strong>Error!</strong>&nbsp;Debe ingresar una cantidad para el color
                   </p>
                 </div>

                 <div class="row">
                   <div class="col-sm-12">
                     <div class="form-group">
                       <button type="button" name="button" class="btn btn-info" onclick="mostrar()">
                         <i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;
                         Adjuntar Imágen
                       </button>
                     </div>
                   </div>
                 </div>

                 <div class="row">
                   <div class="adjuntarimagenes" id="imagenes">
                     <div class="images">
                       <div class="col-xs-12 col-sm-12 col-md-5">
                         <div class="form-group">
                           <label for="exampleInputFile">Imágen 1 (principal) <span class="red">*</label>
                           <input type="file" name="imagen1" onchange="ValidarImagen()">
                         </div>
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-2">
                         <div class="form-group">
                           <label for="exampleInputFile">Imágen 2 (secundaria)</label>
                           <input type="file" name="imagen2">
                         </div>
                       </div>
                     </div>

                     <div class="images">
                       <div class="col-xs-12 col-sm-12 col-md-10">
                         <div class="form-group">
                           <label for="exampleInputFile">Imágen 3 (secundaria)</label>
                           <input type="file" name="imagen3">
                           <p class="help-block">Solo se admiten archivos jpg, gif, png, jpeg menores de 1 MB</p>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>

                 <!-- Alert imagen principal requerida -->
                 <div class="container-prod ocultar" id="avisoimagenrequerida">
                   <div class="alert alert-danger alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button>
                     <p class="centrar">
                       <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                       <strong>Error!</strong>&nbsp; Debe seleccionar una imágen principal
                     </p>
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
                        <button type="button" class="btn btn-success btn-categoria" onclick="ValidarFormulario()">
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
