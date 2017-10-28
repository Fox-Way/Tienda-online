
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
    <!-- Bootstrap -->
    <script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>js/bootstrap-datepicker.js"></script>

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


    <script src="<?php echo URL; ?>js/application.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/login.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/categorias.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/productos.js"></script>

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
