<?php


class Home extends Controller
{
    private $mdlProductos;
    private $mdlImagenes;
    private $mdlCategorias;

    public function __construct()
    {
      $this->mdlProductos = $this->LoadModel('mdlProductos');
      $this->mdlImagenes = $this->LoadModel('mdlImagenes');
      $this->mdlCategorias = $this->LoadModel('mdlCategorias');
    }

    public function Index()
    {
      $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();
      $productos = $this->mdlProductos->ConsultarProductosConImagen();
      $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

      //paginador
      $totalRegistros = count($productos);
      $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
      if (isset($_GET['busqueda']) && $_GET['busqueda'] != '')
      {
        $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

        $this->mdlProductos->__SET('nombre', $_GET['busqueda']);
        $productosFiltrados = $this->mdlProductos->ConsultarProductosConImagenPorFiltrado();
        $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

        //paginador
        $totalRegistros = count($productosFiltrados);
        $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
        $this->mdlProductos->__SET('nombre', $_GET['busqueda']);
        $productosPorFiltrado = $this->mdlProductos->ConsultarProductosConImagenPorFiltradoConPaginador();

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
      $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/contacto.php';
      require APP . 'view/_templates/footer.php';
    }

    public function AcercaDe()
    {
      $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/acerca.php';
      require APP . 'view/_templates/footer.php';
    }

    public function MostrarProductosPorCategoria()
    {
      if (isset($_GET['categoria']))
      {
        $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

        $this->mdlProductos->__SET('categoria', $_GET['categoria']);
        $productos = $this->mdlProductos->ConsultarProductosConImagenPorIdCategoria();
        $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

        //paginador
        $totalRegistros = count($productos);
        $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
        $this->mdlProductos->__SET('categoria', $_GET['categoria']);
        $productosPorCategoria = $this->mdlProductos->ConsultarProductosPorIdCategoria();


        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/productosPorCategoria.php';
        require APP . 'view/_templates/footer.php';
      }
      else{
        header('location:' . URL . 'home/Index');
        exit;
      }
    }

    public function MostrarProductosPorCategoriaOrdenados()
    {
      if (isset($_GET['categoria']))
      {

        if (isset($_GET['categoria']) && isset($_GET['filter']) && $_GET['filter'] == "mayor-menor")
        {
          $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

          $this->mdlProductos->__SET('categoria', $_GET['categoria']);
          $productos = $this->mdlProductos->ConsultarProductosConImagenPorIdCategoria();
          $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

          //paginador
          $totalRegistros = count($productos);
          $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
          $this->mdlProductos->__SET('categoria', $_GET['categoria']);
          $productosPorCategoriaPorPrecioAsc = $this->mdlProductos->ConsultarProductosPorIdCategoriaOrdenadosPorPrecio();

        }

        if (isset($_GET['categoria']) && isset($_GET['filter']) && $_GET['filter'] == "menor-mayor")
        {
          $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

          $this->mdlProductos->__SET('categoria', $_GET['categoria']);
          $productos = $this->mdlProductos->ConsultarProductosConImagenPorIdCategoria();
          $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

          //paginador
          $totalRegistros = count($productos);
          $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
          $this->mdlProductos->__SET('categoria', $_GET['categoria']);
          $productosPorCategoriaPorPrecioDesc = $this->mdlProductos->ConsultarProductosPorIdCategoriaOrdenadosPorPrecio2();

        }

        if (isset($_GET['categoria']) && isset($_GET['filter']) && $_GET['filter'] == "mayor-dcto")
        {
          $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

          $this->mdlProductos->__SET('categoria', $_GET['categoria']);
          $productos = $this->mdlProductos->ConsultarProductosConImagenPorIdCategoria();
          $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

          //paginador
          $totalRegistros = count($productos);
          $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
          $this->mdlProductos->__SET('categoria', $_GET['categoria']);
          $productosPorCategoriaPorDcto = $this->mdlProductos->ConsultarProductosPorIdCategoriaOrdenadosPorMayorDcto();

        }


          // load views
          require APP . 'view/_templates/header.php';
          require APP . 'view/home/productosPorCategoriaOrdenados.php';
          require APP . 'view/_templates/footer.php';
      } else {
        header('location:' . URL . 'home/Index');
        exit;
      }
    }

    public function Ordenar()
    {
        $categoriasActivas = $this->mdlCategorias->ConsultarCategoriasActivas();

        if (isset($_GET['filter']) && $_GET['filter'] == "mayor-menor")
        {
          $precioMayorMenor = $this->mdlProductos->ConsultarProductosConImagen();
          $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

          //paginador
          $totalRegistros = count($precioMayorMenor);
          $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
          $productosPorPrecioDescConPaginador = $this->mdlProductos->ConsultarProductosPorPrecioDescendenteConPaginador();
        }

        if (isset($_GET['filter']) && $_GET['filter'] == "menor-mayor")
        {
            $precioMenorMayor = $this->mdlProductos->ConsultarProductosConImagen();

            $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

            //paginador
            $totalRegistros = count($precioMenorMayor);
            $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
            $productosPorPrecioAscConPaginador = $this->mdlProductos->ConsultarProductosPorPrecioAscendenteConPaginador();
        }

        if (isset($_GET['filter']) && $_GET['filter'] == "mayor-dcto")
        {
            $mayorDcto = $this->mdlProductos->ConsultarProductosConImagen();

            $paginas = $this->mdlProductos->ConsultarNumeroPaginas();

            //paginador
            $totalRegistros = count($mayorDcto);
            $tamanioPagina = intval($paginas[0]['numero_paginas']);
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
            $productosPorMayorDctoConPaginador = $this->mdlProductos->ConsultarProductosPorMayorDctoConPaginador();
        }
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/ordenar.php';
        require APP . 'view/_templates/footer.php';

    }
}
