<?php

    class Usuarios extends Controller
    {

      private $mdlCuentas;

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
              echo 4;
              exit;
            }

              $ruta = 'C:/xampp/htdocs/Proyecto/public/img/perfil/' . $_FILES['image_perfil']['name'];
              $resultado = move_uploaded_file($_FILES['image_perfil']['tmp_name'], $ruta);
          }

        }
      }

    }
 ?>
