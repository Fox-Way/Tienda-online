<?php


class Administracion extends Controller
{

    private $mdlAdministracion;
    private $mdlCategorias;
    private $mdlColores;
    private $mdlProductos;
    private $mdlImagenes;
    private $mdlMarcas;
    private $mdlCuentas;

    public function __construct()
    {
      $this->mdlAdministracion = $this->LoadModel('mdlAdministracion');
      $this->mdlCategorias = $this->LoadModel('mdlCategorias');
      $this->mdlColores = $this->LoadModel('mdlColores');
      $this->mdlProductos = $this->LoadModel('mdlProductos');
      $this->mdlImagenes = $this->LoadModel('mdlImagenes');
      $this->mdlMarcas = $this->LoadModel('mdlMarcas');
      $this->mdlCuentas = $this->LoadModel('mdlCuentas');
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
      $marcas = $this->mdlMarcas->ConsultarMarcas();

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

            //Consultamos los datos del usuario
            $this->mdlCuentas->__SET('idUsuario', $_SESSION['USUARIO_ID']);
            $usuario = $this->mdlCuentas->ConsultarUsuariosPorId();

            //Consultamos los demas datos del usuario
            $this->mdlCuentas->__SET('idUsuario', $_SESSION['USUARIO_ID']);
            $persona = $this->mdlCuentas->ConsultarPersonaPorId();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/cuentas/cuenta.php';
            require APP . 'view/_templates/footer.php';
          }
    }

    public function EliminarProducto()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {

        if (isset($_POST['idproducto']) && $_POST['idproducto'] != '')
        {

            //Consultar imagen producto con prioridad 1
            $this->mdlImagenes->__SET('idProducto', $_POST['idproducto']);
            $imagen1 = $this->mdlImagenes->ConsultarImagenPorIdProducto();

            if (isset($imagen1[0]['nombre']) && $imagen1[0]['nombre'] != '')
            {
                $ruta = 'C:/xampp/htdocs/Proyecto/public/img/images-productos/' . $imagen1[0]['nombre'];

                //Eliminar imagen principal
                if(file_exists($ruta))
                {
                  unlink($ruta);
                }
            }

              //Consultar imágen del producto con prioridad 2
            $this->mdlImagenes->__SET('idProducto', $_POST['idproducto']);
            $imagen2 = $this->mdlImagenes->ConsultarImagenPrioridad2();

            if (isset($imagen2[0]['nombre']) && $imagen2[0]['nombre'] != '')
            {
                $ruta = 'C:/xampp/htdocs/Proyecto/public/img/images-productos/' . $imagen2[0]['nombre'];

                //Eliminar imágen 2
                if(file_exists($ruta))
                {
                  unlink($ruta);
                }
            }

              //Consultar imagen con prioridad 3
              $this->mdlImagenes->__SET('idProducto', $_POST['idproducto']);
              $imagen3 = $this->mdlImagenes->ConsultarImagenPrioridad3();

              if (isset($imagen3[0]['nombre']) && $imagen3[0]['nombre'] != '')
              {
                  $ruta = 'C:/xampp/htdocs/Proyecto/public/img/images-productos/' . $imagen2[0]['nombre'];

                  //eliminar imagen 3
                  if(file_exists($ruta))
                  {
                    unlink($ruta);
                  }
              }

                //Eliminar imágenes de la tabla imagenes
                $this->mdlImagenes->__SET('idProducto', $_POST['idproducto']);
                $imagenes = $this->mdlImagenes->EliminarImagenProducto();

                //Eliminar produto de la tabla productos
                $this->mdlProductos->__SET('id', $_POST['idproducto']);
                $producto = $this->mdlProductos->EliminarProducto();

                //Eliminar produto de la tabla productos_colores
                $this->mdlColores->__SET('idProducto', $_POST['idproducto']);
                $colores = $this->mdlColores->EliminarDetallesColor();

                //Eliminar produto de la tabla productos_marcas
                $this->mdlMarcas->__SET('idProducto', $_POST['idproducto']);
                $marcas = $this->mdlMarcas->EliminarDetallesMarcas();

                if ($imagenes && $producto && $colores && $marcas)
                {
                  echo 1;
                }
                else {
                  echo 2;
                }
        }
      }
    }

    public function ActualizarCuenta()
    {
      if (isset($_SESSION['SESION_INICIADA']) &&
          $_SESSION['SESION_INICIADA'] == true)
      {
        sleep(2);


        //Guardar imágen de perfil
        if ($_FILES['foto']['name'] != "")
        {

          $ext = explode(".", $_FILES['foto']['name']);
          $extension = end($ext);
          $_FILES['foto']['name'] = $_SESSION['USUARIO'] . "." . $extension;

          $ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' . $_FILES['foto']['name'];

          if(file_exists($ruta))
          {
            unlink($ruta);
          }

          $permitidos = array(
            "image/jpg",
            "image/jpeg"
          );

          if (!in_array($_FILES['foto']['type'], $permitidos)) {
            echo 4;
            exit;
          }

            $ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' . $_FILES['foto']['name'];
            $resultado = move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        }

        //Consultamos si existe ya un email igual al ingresado
        $this->mdlCuentas->__SET('email', $_POST['email_user']);
        $this->mdlCuentas->__SET('idUsuario', $_SESSION['USUARIO_ID']);
        $email = $this->mdlCuentas->ConsultarEmailUsuario();

        //Consultamos si existe ya un nombre de usuario agual al ingresado
        $this->mdlCuentas->__SET('usuario', $_POST['user']);
        $this->mdlCuentas->__SET('idUsuario', $_SESSION['USUARIO_ID']);
        $usuario = $this->mdlCuentas->ConsultarNombreUsuario();

        if ($email[0]['email'] == 0)
        {
          //Actualizar tabla usuarios
          $this->mdlCuentas->__SET('usuario', $_POST['user']);
          $this->mdlCuentas->__SET('email', $_POST['email_user']);
          $this->mdlCuentas->__SET('idUsuario', $_SESSION['USUARIO_ID']);
          $users = $this->mdlCuentas->ActualizarUsuarios();

          if ($usuario[0]['usuario'] == 0) {
            //Actualizar tabla personas
            $this->mdlCuentas->__SET('fechaNacimiento', $_POST['date']);
            $this->mdlCuentas->__SET('nombres', $_POST['nombres']);
            $this->mdlCuentas->__SET('apellidos', $_POST['apellidos']);
            $this->mdlCuentas->__SET('idUsuario', $_SESSION['USUARIO_ID']);
            $persona = $this->mdlCuentas->ActualizarPersonaPorId();
          }
          else{
            echo 3;
          }

          echo 1;
        }
        else
        {
          echo 2;
        }
      }
    }
}
