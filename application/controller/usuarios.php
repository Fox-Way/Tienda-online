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
              $ultimoUsuario = $this->mdlCuentas->ConsultarUltimoUsuarioGuardado();

              //Guardamos tabla personas
              $this->mdlCuentas->__SET('nombres', ucwords($_POST['nombre_persona']));
              $this->mdlCuentas->__SET('apellidos', ucwords($_POST['apellidos_persona']));

              //Validamos que el formato de la fecha sea válido
              $fecha = $_POST['fecha'];
              $explode = explode('-', $fecha);

              $fecha = $_POST['fecha'];

              if (!empty($fecha))
              {
                $explode = explode('-', $fecha);

                if(!($explode[0] >= 1 && $explode[0] <= 31) ||
                   !($explode[1] >= 1 && $explode[1] <= 12) ||
                   !($explode[2] >= 1900 && $explode[2] <= 3000))
                   {
                     echo 4;
                     exit;
                   }
              }

              $this->mdlCuentas->__SET('fechaNacimiento', $_POST['fecha']);
              $this->mdlCuentas->__SET('idUsuario', $ultimoUsuario[0]['ultimo']);
              $successPersona = $this->mdlCuentas->GuardarDatosPersona();

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

      public function VerUsuarios()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
            $_SESSION['SESION_INICIADA'] == true)
        {

            if (isset($_POST['idusuario']))
            {
              $this->mdlCuentas->__SET('idUsuario', $_POST['idusuario']);
              $usuario = $this->mdlCuentas->ConsultarUsuarioPorId();

            foreach ($usuario as $val) {

              echo json_encode([
                'id' => $val['id'],
                'usuario' => $val['usuario'],
                'email' => $val['email'],
                'nombres' => $val['nombres'],
                'apellidos' => $val['apellidos'],
                'fecha' => $val['fecha_nacimiento'],
                'rol' => $val['nombre']
              ]);
            }
            }
            else
            {
              header('location:' .URL.'usuarios/ListarUsuarios');
              exit;
            }
        }
        else {
          header('location:' .URL.'administracion/IniciarSesion');
          exit;
        }
      }

      public function ActualizarUsuarios()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
            $_SESSION['SESION_INICIADA'] == true)
        {

          sleep(2);

          //Consultamos que no exista un nombre de usuario repetido en la base de datos
          $this->mdlCuentas->__SET('usuario', $_POST['name_user']);
          $this->mdlCuentas->__SET('idUsuario', $_POST['iduser']);
          $usuario = $this->mdlCuentas->ConsultarNombreUsuarioPorId();

          //Consultamos que no exista un email repetido en la base de datos
          $this->mdlCuentas->__SET('email', $_POST['email_details']);
          $this->mdlCuentas->__SET('idUsuario', $_POST['iduser']);
          $email= $this->mdlCuentas->ConsultarEmailPorId();

          if ($usuario[0]['usuario'] == 0 && $email[0]['email'] == 0)
          {
            //Actualizamos la tabla usuarios
            $this->mdlCuentas->__SET('email', $_POST['email_details']);
            $this->mdlCuentas->__SET('usuario', $_POST['name_user']);
            $this->mdlCuentas->__SET('idUsuario', $_POST['iduser']);
            $email= $this->mdlCuentas->ActualizarUsuario();
            echo 1;
          }
          else {
            {
              echo 2;
            }
          }

        }
        else
        {
          header('location:' .URL.'administracion/IniciarSesion');
          exit;
        }
      }

      public function CambiarEstadoUsuario()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
            $_SESSION['SESION_INICIADA'] == true)
        {

          sleep(2);

          if(isset($_POST['idusuario']))
          {
            //Cambiamos el estado del usuario
            $this->mdlCuentas->__SET('idUsuario', $_POST['idusuario']);
            $estadoUsuario = $this->mdlCuentas->CambiarEstadoUsuario();
            echo 1;
          }
        }
        else
        {
          header('location:' .URL.'administracion/IniciarSesion');
          exit;
        }
      }

    }
 ?>
