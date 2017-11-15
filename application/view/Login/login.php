
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel-login panel panel-primary">
        <div class="panel-heading panel-title">
          <center>Login</center>
        </div>
        <div class="panel-body">
          <form action="<?= URL ?>LoginCtrl/iniciar" method="POST" role="form">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" placeholder="Email" id="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" name="password" id="email" placeholder="****" class="form-control">
            </div>
            <!-- <div class="form-group">
            <a href="#" class="btn btn-default">
              <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
              <span class="bold">Registrarme</span>
            </a>
            <a href="#" class="btn btn-default pull-right">
              <i class="fa fa-key" aria-hidden="true"></i>&nbsp;
              <span class="bold">Recuperar Contraseña</span>
            </a>
            </div> -->
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="btn-login"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Iniciar Sesión</button>
            </div>
          </form>
          <?php if(isset($_GET['error']) && $_GET['error'] == 'campos_vacios'): ?>
              <div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Por favor llenar todos los campos</div>
          <?php endif; ?>

          <?php if(isset($_GET['error']) && $_GET['error'] == 'rol_no_existe'): ?>
              <div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;El rol que tiene asociado es inválido</div>
          <?php endif; ?>

          <?php if(isset($_GET['error']) && $_GET['error'] == 'usuario_invalido'): ?>
              <div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Usuario o contraseña inválidos</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
