
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
               <form class="form-horizontal">
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
                       <input type="text" class="form-control" name="categoria" id="categoria" onkeypress="ValidarCategoria()">
                     </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <div class="col-sm-offset-2 col-sm-10">
                     <button type="button" class="btn btn-success btn-categoria" name="btn-categoria" id="btn-categoria">
                       <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;
                       Guardar
                     </button>
                   </div>
                 </div>
               </form>

               <div id="_AJAX_"></div>

               <!-- Alert longitud campo -->
             <div class="alert alert-danger alert-dismissible ocultar" id="avisocategoria" role="alert">
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
                             </tr>
                           </thead>
                           <tbody>
                           <?php foreach ($categorias as $record): ?>
                             <tr>
                               <td><?php echo $record['id']; ?></td>
                               <td><?php echo $record['nombre']; ?></td>
                               <td><?php echo $record['estado'] == 1 ? 'Habilitado' : 'Inhabilitado'; ?></td>
                               <td>Opciones</td>
                             </tr>
                           <?php endforeach; ?>
                           </tbody>
                         </table>
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
