
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
      }
 ?>
