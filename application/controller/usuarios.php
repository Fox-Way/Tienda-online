<?php

    class Usuarios extends Controller
    {

      private $mdlCuentas;

      private function Encrypt($string)
      {
        $sizeof = strlen($string) - 1;
        $result = '';
        for ($x = $sizeof; $x >= 0; $x--)
        {
          $result .= $string[$x];
        }
        $result = md5($result);
        return $result;
      }

      public function __construct()
      {
        $this->mdlCuentas = $this->LoadModel('mdlCuentas');
      }

      public function RegistrarUsuarios()
      {

          if (isset($_SESSION['SESION_INICIADA']) &&
              $_SESSION['SESION_INICIADA'] == true)
          {

            $roles = $this->mdlCuentas->ConsultarRoles();
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/usuarios/registro.php';
            require APP . 'view/_templates/footer.php';
          }
          else
          {
            header('location:' . URL . 'administracion/IniciarSesion');
            exit;
          }
      }

      public function ListarUsuarios()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
            $_SESSION['SESION_INICIADA'] == true)
        {
          $usuarios = $this->mdlCuentas->ListarUsuarios();

          // load views
          require APP . 'view/_templates/header.php';
          require APP . 'view/usuarios/listado.php';
          require APP . 'view/_templates/footer.php';
        }
        else
        {
          header('location:' . URL . 'administracion/IniciarSesion');
          exit;
        }
      }

      public function GuardarUsuarios()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
            $_SESSION['SESION_INICIADA'] == true)
        {

          sleep(2);

          //Guardar imágen de perfil
          if ($_FILES['image_perfil']['name'] != "")
          {

            $ext = explode(".", $_FILES['image_perfil']['name']);
            $extension = end($ext);
            $_FILES['image_perfil']['name'] = $_POST['nombre_usuario'] . "." . $extension;

            $ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' . $_FILES['image_perfil']['name'];

            if(file_exists($ruta))
            {
              unlink($ruta);
            }

            $permitidos = array(
              "image/jpg",
              "image/jpeg"
            );

            if (!in_array($_FILES['image_perfil']['type'], $permitidos)) {
              echo 3;
              exit;
            }

              $ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' . $_FILES['image_perfil']['name'];
              $resultado = move_uploaded_file($_FILES['image_perfil']['tmp_name'], $ruta);
          }

          $this->mdlCuentas->__SET('usuario', $_POST['nombre_usuario']);
          $usuario = $this->mdlCuentas->ConsultarUsuario();

          $this->mdlCuentas->__SET('email', $_POST['correo_user']);
          $email= $this->mdlCuentas->ConsultarEmail();

          if ($usuario[0]['usuario'] == 0 && $email[0]['email'] == 0)
          {
              //Guardamos en la tabla usuarios
              $this->mdlCuentas->__SET('usuario', ucwords($_POST['nombre_usuario']));
              $this->mdlCuentas->__SET('email', $_POST['correo_user']);
              $this->mdlCuentas->__SET('pass', $this->Encrypt($_POST['pass']));
              $this->mdlCuentas->__SET('rol', $_POST['rol']);
              $this->mdlCuentas->__SET('estadoUsuario', 1);
              $this->mdlCuentas->GuardarUsuario();

              /*Consultamos el último id del usuario
                que se guardo para poder relacionarlo con la tabla personas*/
              $ultimo_usuario = $this->mdlCuentas->ConsultarUltimoUsuarioGuardado();

              //Guardamos tabla personas
              $this->mdlCuentas->__SET('nombres', ucwords($_POST['nombre_persona']));
              $this->mdlCuentas->__SET('apellidos', ucwords($_POST['apellidos_persona']));
              $this->mdlCuentas->__SET('fechaNacimiento', $_POST['fecha']);
              $this->mdlCuentas->__SET('idUsuario', $ultimo_usuario[0]['ultimo']);
              $success_persona = $this->mdlCuentas->GuardarDatosPersona();

              echo 1;

          }
          else
          {
            echo 2;
          }

        }

        else
        {
          header('location:' .URL. 'administracion/IniciarSesion');
          exit;
        }
      }

    }
 ?>
