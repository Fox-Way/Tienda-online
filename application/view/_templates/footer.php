
    <footer class="wow bounceInDown" data-wow-duration="2s">
      <p>
        Todos los derechos reservados
      </p>
      <center><p> &copy; FoxWay <?php echo Date('Y'); ?></p></center>
    </footer>

    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <script src="<?php echo URL; ?>js/jquery.min.js"></script>

    <!-- Modal modificación número páginas paginador-->
    <div class="modal fade" id="edicionPaginas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="LimpiarDatosMarca()"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title modal-details-pdcts" id="myModalLabel" align="center"><strong>Edición Páginas</strong></h5>
        </div>
        <div class="modal-body">
            <form name="formeditpaginas" id="form-edit-paginas">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label for="paginas">Número de páginas</label>
                    <input type="number" min="1" id="paginas" name="paginas" class="form-control">
                  </div>
                </div>
              </div>
              <input type="hidden" name="idpagina" id="idpagina">
           </form>

            <!-- Alert numero obligatorio -->
            <div class="alert alert-danger alert-dismissible ocultar" id="aviso_numero" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
              <p class="centrar">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                <strong>Error!</strong>&nbsp;Debes ingresar un número válido
              </p>
            </div>

            <!-- Alert número -->
            <div class="alert alert-danger alert-dismissible ocultar" id="avisonumeroinvalido" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
              <p class="centrar">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                <strong>Error!</strong>&nbsp;Debes ingresar un número mayor a cero (0)
              </p>
            </div>

            <!-- Alert actualización exitosa -->
            <div class="alert alert-success alert-dismissible ocultar" id="successnumero" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
              <p class="centrar">
                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                <strong>Enhorabuena!</strong>&nbsp;Datos actualizados correctamente
              </p>
            </div>

            <!-- Alert procesando -->
            <center class="ocultar" id="procesando">
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
          <button type="button" class="btn btn-success" onclick="ValidarDatosNumeroPaginas()" id="btn-editarpaginas">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;
            Actualizar
          </button>
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="LimpiarModal()">
            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
            Cerrar
          </button>
        </div>
      </div>
    </div>
    </div>
    <!-- Fin modal paginas -->

    <!-- Bootstrap -->
    <script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>js/bootstrap-datepicker.js"></script>
    <script src="<?php echo URL; ?>js/bootstrap-submenu.js"></script>

    <!-- Template -->
    <script src="<?php echo URL; ?>js/modernizr.custom.js"></script>
    <script src="<?php echo URL; ?>js/classie.js"></script>
    <script src="<?php echo URL; ?>js/screenfull.js"></script>
    <script src="<?php echo URL; ?>js/screen.js"></script>
    <script src="<?php echo URL; ?>js/jquery.nicescroll.js"></script>
    <script src="<?php echo URL; ?>js/scripts.js"></script>

    <!-- DataTables -->
    <script src="<?php echo URL; ?>js/jquery.dataTables.min.js"></script>

    <!-- Select 2 -->
    <script src="<?php echo URL; ?>js/select2.min.js"></script>

    <!-- Start Lightbox -->
    <script type="text/javascript" src="<?php echo URL; ?>lightbox/vlb_engine/visuallightbox.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>lightbox/vlb_engine/vlbdata1.js"></script>

    <!-- Sweetalert2 -->
    <script type="text/javascript" src="<?php echo URL ?>js/sweetalert2.all.min.js"></script>

    <!-- Datepicker -->
    <script type="text/javascript" src="<?php echo URL ?>js/bootstrap-datepicker.js"></script>


    <script src="<?php echo URL; ?>js/application.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/login.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/categorias.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/productos.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/cuentas.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/marcas.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/usuarios.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/paginas.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#table-categories').DataTable({
          "ordering": false,
        });
        $('#table-categories').DataTable();
      });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#table-productos').DataTable({
          "ordering": false,
        });
        $('#table-productos').DataTable();
      });
    </script>

</body>
</html>
