<?php


class Administracion extends Controller
{

    private $mdlAdministracion;
    private $mdlCategorias;
    private $mdlColores;
    private $mdlProductos;
    private $mdlImagenes;

    public function __construct()
    {
      $this->mdlAdministracion = $this->LoadModel('mdlAdministracion');
      $this->mdlCategorias = $this->LoadModel('mdlCategorias');
      $this->mdlColores = $this->LoadModel('mdlColores');
      $this->mdlProductos = $this->LoadModel('mdlProductos');
      $this->mdlImagenes = $this->LoadModel('mdlImagenes');
    }

    public function IniciarSesion()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/administracion/inicioSesion.php';
        require APP . 'view/_templates/footer.php';
    }

    public function Validar()
    {

      sleep(2);
      if (isset($_POST['email']) && isset($_POST['pass']))
      {
        if ($_POST['email'] != null &&
            $_POST['pass'] != null) {

          $this->mdlAdministracion->__SET('email', $_POST['email']);
          $this->mdlAdministracion->__SET('password', $_POST['pass']);

          $user = $this->mdlAdministracion->ConsultarUsuarios();

          $this->mdlAdministracion->__SET('email', $_POST['email']);
          $rol = $this->mdlAdministracion->ConsultarRolPorId();

            if (count($user) != 0)
              {
                foreach ($user as $value) {

                    if ($value['email'] == $_POST['email'] &&
                        $value['password'] == $_POST['pass'] &&
                        $value['id_rol'] == 1 && $value['estado'] == 1) {

                        $_SESSION['SESION_INICIADA'] = true;
                        $_SESSION['USUARIO_ID'] = $value['id'];
                        $_SESSION['USUARIO'] = $value['usuario'];
                        $_SESSION['ROL_ID'] = $value['id_rol'];
                        $_SESSION['ROL'] = $rol[0]['rol'];
                        $_SESSION['EMAIL'] = $value['email'];
                        $_SESSION['ESTADO'] = $value['estado'];

                      echo 1;
                    }
                }
              }

        }else{
          header('location:'. URL . 'administracion/IniciarSesion');
          exit;
        }

      }
      else{
        header('location:'. URL . 'administracion/IniciarSesion');
        exit;
      }
    }

    public function Index()
    {

      if(isset($_SESSION['SESION_INICIADA']) &&
               $_SESSION['SESION_INICIADA'] == true)
      {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/administracion/dashboard.php';
        require APP . 'view/_templates/footer.php';

      }else{
        header('location:' . URL . 'administracion/IniciarSesion');
      }
    }

    public function Categorias()
    {
      if(isset($_SESSION['SESION_INICIADA']) &&
               $_SESSION['SESION_INICIADA'] == true){

        $categorias = $this->mdlCategorias->ConsultarCategorias();
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/administracion/categorias.php';
        require APP . 'view/_templates/footer.php';
      }
      else{
        header('location:' . URL . 'administracion/IniciarSesion');
        exit();
      }
    }

    public function CerrarSesion()
    {
        unset($_SESSION['SESION_INICIADA'],$_SESSION['USUARIO_ID'],
              $_SESSION['USUARIO'], $_SESSION['ROL_ID'], $_SESSION['ROL'],
              $_SESSION['EMAIL'], $_SESSION['ESTADO']);

        session_destroy();

          header('location:' . URL . 'administracion/IniciarSesion');
          exit();
    }

    public function RecuperarContrasenia()
    {
      return "recuperacion de contraseña";
    }

    public function Perfil()
    {
      if(isset($_SESSION['SESION_INICIADA']) &&
               $_SESSION['SESION_INICIADA'] == true)
      {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/perfil/perfil.php';
        require APP . 'view/_templates/footer.php';
      }else{
        header('location:' . URL . 'administracion/IniciarSesion');
        exit();
      }
    }

    public function Registrar()
    {
      if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == true) {

      $categorias = $this->mdlCategorias->ConsultarCategorias();
      $colores = $this->mdlColores->consultarColores();

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/productos/registrar.php';
        require APP . 'view/_templates/footer.php';
      }
      else{
        header('location:' . URL . 'administracion/IniciarSesion');
        exit;
      }
    }

    public function Listar()
    {
      if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == true) {

        $productos = $this->mdlProductos->ConsultarProductosConImagen();

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/productos/listado.php';
        require APP . 'view/_templates/footer.php';
      }
      else{
        header('location:' . URL . 'administracion/IniciarSesion');
        exit;
      }
    }

    public function Interruptor()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        sleep(2);

        if($_POST['interruptor'] == 'activado')
        {
          $this->mdlProductos->__SET('id', $_POST['id']);
          $this->mdlProductos->CambiarEstadoProductoActivado();

          echo "Producto activado correctamente";
        }

        if($_POST['interruptor'] == 'desactivado')
        {
          $this->mdlProductos->__SET('id', $_POST['id']);
          $this->mdlProductos->CambiarEstadoProductoDesactivado();

          echo "Producto desactivado correctamente";
        }
      }
    }

    public function ConfiguracionCuenta()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
          {
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/cuentas/cuenta.php';
            require APP . 'view/_templates/footer.php';
          }
    }
}
