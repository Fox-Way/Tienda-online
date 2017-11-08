<?php


class Home extends Controller
{
    private $mdlProductos;
    private $mdlImagenes;

    public function __construct()
    {
      $this->mdlProductos = $this->LoadModel('mdlProductos');
      $this->mdlImagenes = $this->LoadModel('mdlImagenes');
    }

    public function Index()
    {
      $productos = $this->mdlProductos->ConsultarProductosConImagen();

      //paginador
      $totalRegistros = count($productos);
      $tamanioPagina = 12;
      $pagina = false;

      if (isset($_GET['pagina'])) {
        $pagina = $_GET['pagina'];
      }

      if (!$pagina) {
        $inicio = 0;
        $pagina = 1;
      } else {
        $inicio = ($pagina - 1) * $tamanioPagina;
      }

      $totalPaginas = ceil($totalRegistros / $tamanioPagina);
      $this->mdlProductos->__SET('pagina', $inicio);
      $this->mdlProductos->__SET('tamanio', $tamanioPagina);
      $productosPaginador = $this->mdlProductos->ConsultarProductosParaPaginador();

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function Buscador()
    {
      if (isset($_POST['btn-buscar']) && isset($_POST['busqueda']) &&
          $_POST['busqueda'] != '')
      {

        $this->mdlProductos->__SET('nombre', $_POST['busqueda']);
        $productosFiltrados = $this->mdlProductos->ConsultarProductosConImagenPorFiltrado();
        // $productos_filtrados = $this->mdlProductos->ConsultarProductosPorFiltrado();

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/filtrado.php';
        require APP . 'view/_templates/footer.php';
      }

      else{
        header('location:' . URL . 'home/Index');
        exit;
      }
    }

    public function Contacto()
    {
      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/contacto.php';
      require APP . 'view/_templates/footer.php';
    }

    public function AcercaDe()
    {
      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/acerca.php';
      require APP . 'view/_templates/footer.php';
    }
}
