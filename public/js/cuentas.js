function ValidarUsuario()
{
  var user = $('#user').val();

  if (user.length <=3)
  {
      $('#avisouser').show('slow');
      $('#user').css('border', '1px solid #f22012');
  }
  else
  {
    $('#avisouser').hide('fast');
    $('#user').css('border', '1px solid #17dd37');
  }
}

function ValidarEmailUser()
{
  var correo = $('#email_user').val();
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if (expr.test(correo)) {
    $('#email_user').css('border', '1px solid #17dd37');
    $('#avisoemailuser').hide('fast');
    return true;
  }
  else{
    $('#email_user').css('border', '1px solid #f22012');
    $('#avisoemailuser').show('slow');
    return false;
  }
}



function ValidarFormularioCuenta()
{
    if (document.formcuenta.email_user.value == "")
    {
        $("#avisorequerido").show('slow');
        document.formcuenta.email_user.style.border = "1px solid #f22012";
        $("#email_user").focus();
    }

    if (document.formcuenta.email_user.value != "")
    {
        $("#avisorequerido").hide('fast');
        document.formcuenta.email_user.style.border = "1px solid #17dd37";
    }

    if (document.formcuenta.user.value == "")
    {
        $("#avisorequerido").show('slow');
        document.formcuenta.user.style.border = "1px solid #f22012";
        $("#user").focus();
    }

    if (document.formcuenta.user.value != "")
    {
        $("#avisorequerido").hide('fast');
        document.formcuenta.user.style.border = "1px solid #17dd37";
    }

    if (document.formcuenta.email_user.value != "" &&
        document.formcuenta.user.value != "")
    {

        var formData = new FormData($("#form-cuenta")[0]);

        var nombre_usuario = document.formcuenta.user.value;
        var email = document.formcuenta.email_user.value;
        var fecha = document.formcuenta.date.value;
        var nombres = document.formcuenta.nombres.value;
        var apellidos = document.formcuenta.apellidos.value;
        var foto = document.formcuenta.foto.value;

        $.ajax({
          url: url + 'administracion/ActualizarCuenta',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#errorformatoimagen").hide('fast');
            $("#emailrepetido").hide('fast');
            $("#usuariorepetido").hide('fast');
            $("#exito").hide('fast');
            $("#carga").show("fast");
          },
          success: function(resp){

            if (resp == 1) {
              $("#carga").hide("fast");
              $("#emailrepetido").hide('slow');
              $("#usuariorepetido").hide('slow');
              $("#exito").show('slow');
            }

            if (resp == 2) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#emailrepetido").show('slow');
              $("#usuariorepetido").hide('fast');
              document.formcuenta.email_user.style.border = "1px solid #f22012";
            }

            if (resp == 3) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#usuariorepetido").show('slow');
              $("#emailrepetido").hide('fast');
              document.formcuenta.user.style.border = "1px solid #f22012";
            }

            if (resp == 4) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#usuariorepetido").hide('fast');
              $("#emailrepetido").hide('fast');
              $("#errorformatoimagen").show('slow');
            }
          }
        });
    }
}
