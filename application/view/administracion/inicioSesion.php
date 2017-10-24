
        <header>
          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <div class="cabecera"></div>
                <nav class="wow bounceInLeft" data-wow-duration="2s">
                  <?php require APP. 'view/_templates/menu.php'; ?>
                </nav>
            </div>
          </div>
        </header>

    <div class="row">
        <div class="main-login">
            <div class="col-md-6 col-md-offset-3">
              <div class="login-panel panel panel-primary ">
                <div class="panel-heading">
                  <center><h2 class="form-signin-heading">Login</h2></center>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                        <div class="form-group">
                          <label for="email">Correo Electrónico <span class="red">*</span></label>
                          <input type="email" id="email" name="email" class="form-control" onkeyup="ValidarEmail()" onkeypress="ValidarCampos()">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                        <div class="form-group">
                          <label for="pass">Contraseña <span class="red">*</span></label>
                          <input type="password" id="pass" name="password" class="form-control" onkeyup="ValidarPassword()" onkeypress="ValidarCampos()">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                        <div class="form-group">
                          <button class="btn btn-primary btn-block" type="button" id="btn-login" name="btn-login" onclick="ValidarFormulario()">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Iniciar Sesión
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                        <div class="form-group">
                          <button type="button" name="button" class="btn btn-default btn-block">
                            <i class="fa fa-key" aria-hidden="true"></i>&nbsp;
                            Recuperar Contraseña
                          </button>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div id="_AJAX_"></div>

                  <!-- Alert campos vacíos -->
                <div class="alert alert-danger alert-dismissible ocultar" id="avisocampos" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <p class="centrar">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                    Debe llenar todos los campos con <span class="red">*</span> obligatoriamente
                  </p>
                </div>

            <!-- Alert correo inválido -->
            <div class="alert alert-danger alert-dismissible ocultar" id="avisoemail" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
              <p class="centrar">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                Utiliza un formato que coincida con el solicitado (mail@example.com)</p>
            </div>

            <!-- Alert password -->
            <div class="alert alert-danger alert-dismissible ocultar" id="avisopass" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
              <p class="centrar">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                La contraseña debe contener minímo 8 caracteres</p>
            </div>
        </div>
    </div>
