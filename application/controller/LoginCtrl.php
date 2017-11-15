<?php


class LoginCtrl extends Controller
{
  private $model;

  function __construct()
  {
    try {
      $this->model = $this->loadModel('mdlLogin');
    } catch (Exception $e) {
        return $e->getMessage();
    }

  }

  public function index()
  {
    require APP.'view/_templates/header.php';
    require APP.'view/Login/Login.php';
    require APP.'view/_templates/footer.php';
  }

  public function iniciar()
  {
    if (isset($_POST['btn-login'])) {
      if ($_POST['email'] != null && $_POST['password'] != null) {

        $this->model->__SET('email', $_POST['email']);
        $this->model->__SET('pass', $_POST['password']);
        $usuario = $this->model->buscarUsuario();

        if ($usuario['email'] == $_POST['email'] &&
            $usuario['password'] == $_POST['password'] &&
            $usuario['id_rol'] == 1 && $usuario['estado'] == 1) {

          $_SESSION['SESION INICIADA'] = true;
          $_SESSION['user'] = $_POST['email'];
          require APP . 'view/_templates/header.php';
          require APP . 'view/Dashboard/dashboard_administrador.php';
          require APP . 'view/_templates/footer.php';
        }
        elseif($usuario['email'] == $_POST['email'] &&
               $usuario['password'] == $_POST['password'] &&
               $usuario['id_rol'] == 2 && $usuario['estado'] == 1){
          $_SESSION['SESION INICIADA'] = true;
          $_SESSION['user'] = $_POST['email'];
          require APP . 'view/_templates/header.php';
          require APP . 'view/Dashboard/dashboard_vendedor.php';
          require APP . 'view/_templates/footer.php';
        }

        elseif($usuario['email'] != $_POST['email'] ||
               $usuario['password'] != $_POST['password']){
          header("Location:".URL."LoginCtrl/index?error=usuario_invalido");
          exit();
        }

        else{
          header("Location:".URL."LoginCtrl/index?error=rol_no_existe");
          exit();
        }
      }else{
        echo "Debes llenar todos los campos";
        header("Location:".URL."LoginCtrl/index?error=campos_vacios");
        exit();
      }
    }
  }

  public function cerrarSesion()
  {
    if (isset($_SESSION['SESION INICIADA'])) {
      session_start();
      session_destroy();
    }
    header("Location:".URL."LoginCtrl/index");
    exit();
  }

  public function dashboard_admin()
  {
    require APP . 'view/_templates/header.php';
    require APP . 'view/Dashboard/dashboard_administrador.php';
    require APP . 'view/_templates/footer.php';
  }

  public function dashboard_rol2()
  {
    require APP . 'view/_templates/header.php';
    require APP . 'view/Dashboard/dashboard_vendedor.php';
    require APP . 'view/_templates/footer.php';
  }
}
