
<?php

  class Categorias extends Controller
  {
    private $mdlCategorias;
    private $mdlProductos;

    public function __construct()
    {
      $this->mdlCategorias = $this->LoadModel('mdlCategorias');
      $this->mdlProductos = $this->LoadModel('mdlProductos');
    }

    public function GuardarCategorias()
    {
        sleep(2);


        if (isset($_POST['nombrecategoria'])) {
          $this->mdlCategorias->__SET('nombre', $_POST['nombrecategoria']);

          $categoria = $this->mdlCategorias->ConsultarCategoriasPorNombre();

            foreach ($categoria as $categ) {

              if ($categ['nombre'] == "0" ) {

                $this->mdlCategorias->__SET('nombre', $_POST['nombrecategoria']);
                $this->mdlCategorias->__SET('estado', 1);

                $cate = $this->mdlCategorias->GuardarCategorias();
                echo 1;
              }else{
                echo 2;
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
          echo 3;
        }
        else {
          echo 4;
        }
      }
    }

    public function CambiarEstado()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        sleep(2);

          //Consultar los productos que pertenecen a la categoria
          $this->mdlProductos->__SET('categoria', $_POST['idcategoria']);
          $productos = $this->mdlProductos->ConsultarProductosPorCategoria();

          if (count($productos) > 0)
          {
            //Cambiar el estado de los productos que pertenecen a esa categoría
            $this->mdlProductos->__SET('categoria', $_POST['idcategoria']);
            $estado_producto = $this->mdlProductos->CambiarEstadoProductoPorCategoria();

            //Cambiar estado de la categoría
            $this->mdlCategorias->__SET('idCategoria', $_POST['idcategoria']);
            $estado_categoria = $this->mdlCategorias->CambiarEstadoCategoria();
          }

          else {
            //Cambiar estado de la categoría
            $this->mdlCategorias->__SET('idCategoria', $_POST['idcategoria']);
            $estado_categoria = $this->mdlCategorias->CambiarEstadoCategoria();
          }
          echo 1;
      }
    }
}
 ?>
