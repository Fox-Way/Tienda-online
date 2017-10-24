
    function ValidarEmail()
    {
      var correo = $('#email').val();
      expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (expr.test(correo)) {
        $('#email').css('border', '1px solid #17dd37');
        $('#avisoemail').hide('fast');
        return true;
      }
      else{
        $('#email').css('border', '1px solid #f22012');
        $('#avisoemail').show('slow');
        return false;
      }
    }

    function ValidarPassword()
    {
        var pass = $('#pass').val();

        if (pass.length < 8) {
          $('#pass').css('border', '1px solid #f22012');
          $("#avisopass").show("slow");
          return false;
        }else{
          $('#pass').css('border', '1px solid #17dd37');
          $("#avisopass").hide("fast");
          return true;
        }
    }

    function ValidarCampos()
    {
      var email = $('#email').val();
      var pass = $('#pass').val();

      if (email != '' && pass != '') {
        $("#avisocampos").hide("slow");
      }
    }

    document.getElementById('btn-login').onclick = function(){
      var connect, email, pass, form, result;
      email = document.getElementById('email').value;
      pass = document.getElementById('pass').value;

      if (email != '' && pass != '') {
        form = 'email=' + email + '&pass=' + pass;

        connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        connect.onreadystatechange = function()
        {
          if (connect.readyState == 4 && connect.status == 200) {
              if (parseInt(connect.responseText) == 1) {
                //Conexión exitosa y se redirecciona
                result = '<div class="alert alert-dismissible alert-success">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<center><strong><i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>&nbsp;Conectado!</strong> Estamos redireccionando..</center>';
                result += '</div>';
                document.getElementById('_AJAX_').innerHTML = result;
                window.location = url + 'administracion/Index';
              }else{
                //Error: datos incorrectos
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Error! </strong>Credenciales Incorrectas';
                result += '</div>';
                document.getElementById('_AJAX_').innerHTML = result;
              }
          }

          if(connect.readyState != 4){
            //Procesando..
            result = '<div class="alert alert-dismissible alert-warning">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<center><strong><i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>&nbsp;Procesando datos...!</strong></center>';
            result += '</div>';
            document.getElementById('_AJAX_').innerHTML = result;
          }
        }
        connect.open('POST', url + 'administracion/Validar', true);
        connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        connect.send(form);
      }else{
        //Mostrar error de datos vacíos
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp';
        result += 'Error! </strong>Debes llenar todos los campos con <span class="red">*</span> obligatoriamente';
        result += '</div>';
        document.getElementById('email').style.border = '1px solid #f22012';
        document.getElementById('pass').style.border = '1px solid #f22012';
        document.getElementById('_AJAX_').innerHTML = result;
      }
  }
