
<?php

  class Marcas extends Controller
  {
    private $mdlMarcas;

    public function __construct()
    {
        $this->mdlMarcas = $this->LoadModel('mdlMarcas');
    }

    public function Marcas()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        $marcas = $this->mdlMarcas->ConsultarMarcas();
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/marcas/marcas.php';
        require APP . 'view/_templates/footer.php';
      }
      else
      {
        header('location:' . URL . 'administracion/IniciarSesion');
        exit;
      }
    }

    public function GuardarMarcas()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        sleep(2);

        $this->mdlMarcas->__SET('marca', $_POST['marca']);
        $marcas = $this->mdlMarcas->ConsultarMarcasPorNombre();

        {
          foreach ($marcas as $marca) {

            if ($marca['marca'] == "0" || $marca['marca'] == 0) {

              $this->mdlMarcas->__SET('marca', ucwords($_POST['marca']));
              $this->mdlMarcas->__SET('estado', 1);

              $cate = $this->mdlMarcas->GuardarMarcas();
              echo 1;
            }else{
              echo 2;
            }
          }
        }
      }
      else
      {
        header('location:' . URL . 'administracion/IniciarSesion');
        exit;
      }
    }

    public function CargarDatosMarcas()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        $this->mdlMarcas->__SET('idMarca', $_POST['idmarca']);
        $marcas = $this->mdlMarcas->ConsultarMarcaPorId();

        echo json_encode([
          'marca' => $marcas[0]['marca'],
          'idmarca' => $marcas[0]['id_marca'],
        ]);
      }
      else
      {
        header('location:' . URL . 'administracion/IniciarSesion');
        exit;
      }
    }

    public function ActualizarMarcas()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        sleep(2);

        $this->mdlMarcas->__SET('marca', strtolower($_POST['marca_edicion']));
        $this->mdlMarcas->__SET('idMarca', $_POST['idmarca']);
        $nombreMarca = $this->mdlMarcas->ConsultarMarcas2();

        if (intval($nombreMarca[0]['marca']) == 0)
        {
          //Actualizar tabla categorias
          $this->mdlMarcas->__SET('idMarca', $_POST['idmarca']);
          $this->mdlMarcas->__SET('marca', ucwords($_POST['marca_edicion']));

          $this->mdlMarcas->ActualizarMarca();
          echo 3;
        }
        else {
          echo 4;
        }
      }
      else{
          header('location:' . URL . 'administracion/IniciarSesion');
          exit;
      }
    }

    public function CambiarEstado()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        sleep(2);

          //Cambiar estado de la marca
          $this->mdlMarcas->__SET('idMarca', $_POST['idmarca']);
          $estadoMarca= $this->mdlMarcas->CambiarEstadoMarca();

          echo 1;
      }
      else{
          header('location:' . URL . 'administracion/IniciarSesion');
          exit;
      }
    }
}
 ?>
