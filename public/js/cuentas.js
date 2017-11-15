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
    $("#avisorequerido").hide('fast');
  }
}


function ValidarEmailUser()
{
  var correo = $('#email_user').val();
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if (expr.test(correo)) {
    $('#email_user').css('border', '1px solid #17dd37');
    $('#avisoemailuser').hide('fast');
    $("#avisorequerido").hide('fast');
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
    //Validacion email
    if (document.formcuenta.email_user.value == "")
    {
        $("#avisorequerido").show('slow');
        document.formcuenta.email_user.style.border = "1px solid #f22012";
        $("#email_user").focus();
    }

    //validación nombre de usuario
    if (document.formcuenta.user.value == "")
    {
        $("#avisorequerido").show('slow');
        document.formcuenta.user.style.border = "1px solid #f22012";
        $("#user").focus();
    }

    if (document.formcuenta.email_user.value != "")
    {
        document.formcuenta.email_user.style.border = "1px solid #17dd37";
    }

    if (document.formcuenta.user.value != "")
    {
        document.formcuenta.user.style.border = "1px solid #17dd37";
    }

    if (document.formcuenta.email_user.value != "" &&
        document.formcuenta.user.value != "")
    {
      $("#avisorequerido").hide('fast');

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
            $("#emailusuariorepetido").hide('fast');
            $("#exito").hide('fast');
            $("#carga").show("fast");
          },
          success: function(resp){

            if (resp == 1) {
              $("#carga").hide("fast");
              $("#emailusuariorepetido").hide('slow');
              $("#exito").show('slow');
            }

            if (resp == 2) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#emailusuariorepetido").show('slow');
              document.formcuenta.email_user.style.border = "1px solid #f22012";
              document.formcuenta.user.style.border = "1px solid #f22012";
            }

            if (resp == 4) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#emailusuariorepetido").hide('fast');
              $("#errorformatoimagen").show('slow');
            }

            if (resp == 5) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#emailusuariorepetido").hide('fast');
              $("#errorformatoimagen").hide('fast');
              $("#formatofecha").show('slow');
            }
          }
        });
    }
}

function CambiarPassword()
{
  $('#change-password').toggle('slow');
  $('#btn-update-pass').toggle('slow');
}

function validarUpdatePassword()
{
    var pass_larga = true;
    var no_tiene_espacio = true;
    var tiene_numero = false;
    var password = document.formpassword.contrasenia.value;
    var numero_caracteres = password.length;
    if(numero_caracteres < 8) pass_larga = false;

    for (var i = 0; i < numero_caracteres; i++)
    {
      if(password.charAt(i) == " ") no_tiene_espacio = false;

      if(password.charAt(i) == "0" || password.charAt(i) == "1" || password.charAt(i) == "2" || password.charAt(i) == "3" ||
         password.charAt(i) == "4" || password.charAt(i) == "5" || password.charAt(i) == "6" || password.charAt(i) == "7" ||
         password.charAt(i) == "8" || password.charAt(i) == "9")

         tiene_numero = true;
    }

    if(!tiene_numero || !no_tiene_espacio || !pass_larga)
    {
      document.formpassword.contrasenia.style.border ="1px solid #f22012";
      $("#avisoupdatepass").show('slow');
      return false;
    }
    else
    {
      $("#avisoupdatepass").hide('slow');
      document.formpassword.contrasenia.style.border = "1px solid #17dd37";
      return true;
    }
}

function ValidarRepeatContrasenia()
{
  if(document.formpassword.contrasenia.value != document.formpassword.repeat_contrasenia.value)
  {
    document.formpassword.repeat_contrasenia.style.border = "1px solid #f22012";
    $("#avisocontraseniarepeat").show('slow');
    return false;
  }
  else
  {
    document.formpassword.repeat_contrasenia.style.border = "1px solid #17dd37";
    $("#avisocontraseniarepeat").hide('fast');
    return true;
  }
}

function ValidarFormularioPassword()
{
    //Validacion password
    if (document.formpassword.contrasenia.value == "")
    {
        $("#avisorequeridopass").show('slow');
        document.formpassword.contrasenia.style.border = "1px solid #f22012";
        $("#contrasenia").focus();
    }

    //validación nombre de usuario
    if (document.formpassword.repeat_contrasenia.value == "")
    {
        $("#avisorequeridopass").show('slow');
        document.formpassword.repeat_contrasenia.style.border = "1px solid #f22012";
        $("#repeat_contrasenia").focus();
    }

    if (document.formpassword.contrasenia.value != "")
    {
        document.formpassword.contrasenia.style.border = "1px solid #17dd37";
    }

    if (document.formpassword.repeat_contrasenia.value != "")
    {
        document.formpassword.repeat_contrasenia.style.border = "1px solid #17dd37";
    }

    if (document.formpassword.contrasenia.value != "" &&
        document.formpassword.repeat_contrasenia.value != "")
    {
      $("#avisorequeridopass").hide('fast');

        var formData = new FormData($("#form-password")[0]);

        var new_pass = document.formpassword.contrasenia.value;

        $.ajax({
          url: url + 'administracion/ActualizarPassword',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#errorpass").hide('fast');
            $("#exitopass").hide('fast');
            $("#cargapass").show("fast");
          },
          success: function(resp){

            if (resp == 1) {
              $("#cargapass").hide("fast");
              $("#errorpass").hide('slow');
              $("#exitopass").show('slow');
              document.formpassword.contrasenia.value = "";
              document.formpassword.contrasenia.style.border = "1px solid #F1F1F1";
              document.formpassword.repeat_contrasenia.value = "";
              document.formpassword.repeat_contrasenia.style.border = "1px solid #F1F1F1";
              $('#change-password').hide('fast');
              $('#btn-update-pass').hide('fast');

            }

            if (resp == 2) {
              $("#cargapass").hide("fast");
              $("#errorpass").show('slow');
              $("#exitopass").hide('fast');
            }

          }
        });
    }
}
