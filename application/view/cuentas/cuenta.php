
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
                       <label for="user">Usuario</label>
                     </div>
                     <div class="form-group">
                       <input type="text" name="user" id="user" class="form-control">
                     </div>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1">
                     <div class="form-group">
                       <label for="email">Correo Electrónico</label>
                     </div>
                     <div class="form-group">
                       <input type="text" name="email" id="email" class="form-control">
                     </div>
                   </div>
                 </div>
                 <div class="row">

                 </div>
                 <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <button type="button" class="btn btn-success btn-cuenta" onclick="ValidarFormulario()">
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
