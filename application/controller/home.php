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
      $tamanioPagina = 1;
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
      // $result = $this->mdlProductos->ConsultarProductosParaPaginador();
      $productosPaginador = $this->mdlProductos->ConsultarProductosParaPaginador();


        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
