
<?php

      class Categorias extends Controller
      {
        private $mdlCategorias;

        public function __construct()
        {
          $this->mdlCategorias = $this->LoadModel('mdlCategorias');
        }

        public function GuardarCategorias()
        {
            sleep(2);

            if (isset($_POST['cate'])) {
              $this->mdlCategorias->__SET('nombre', $_POST['cate']);

              $categoria = $this->mdlCategorias->ConsultarCategoriasPorNombre();

                foreach ($categoria as $categ) {

                  if ($categ['nombre'] == "0" ) {

                    $this->mdlCategorias->__SET('nombre', $_POST['cate']);
                    $this->mdlCategorias->__SET('estado', 1);

                    $cate = $this->mdlCategorias->GuardarCategorias();
                    echo 1;
                  }
                }
            }
        }

        public function CargarDatos()
        {
          if (isset($_SESSION['SESION_INICIADA']) &&
              $_SESSION['SESION_INICIADA'] == true)
          {
            $this->mdlCategorias->__SET('idCategoria', $_POST['idcategoria']);
            $categoria = $this->mdlCategorias->ConsultarCategoriaPorId();

            echo json_encode([
              'nombre' => $categoria[0]['nombre'],
              'id' => $categoria[0]['id'],
            ]);
          }
        }

        public function ActualizarCategoria()
        {
          if (isset($_SESSION['SESION_INICIADA']) &&
              $_SESSION['SESION_INICIADA'] == true)
          {
            sleep(2);

            $this->mdlCategorias->__SET('nombre', $_POST['categoria_edicion']);
            $this->mdlCategorias->__SET('idCategoria', $_POST['idcategoria']);
            $nombre_categoria = $this->mdlCategorias->ConsultarCategorias2();

            if (intval($nombre_categoria[0]['nombre']) == 0)
            {
              //Actualizar tabla categorias
              $this->mdlCategorias->__SET('idCategoria', $_POST['idcategoria']);
              $this->mdlCategorias->__SET('nombre', $_POST['categoria_edicion']);

              $this->mdlCategorias->ActualizarCategoria();
              echo 'exito';
            }
            else {
              echo 'nombre_categoriarepetido';
            }
          }
        }
      }
 ?>
