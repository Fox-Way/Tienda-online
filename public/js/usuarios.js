$('#fecha').datepicker({
    picktime: false,
    autoclose: true
});

function AdjuntarImagen()
{
  $("#adjuntarimagenusuario").toggle('slow');
}

function ValidarLargoNombre()
{
  if (document.formusuarios.nombre_persona.value.length < 3)
  {
      $("#avisolargolargo").show('slow');
      document.formusuarios.nombre_persona.style.border = "1px solid #f22012";
  }

  if(document.formusuarios.nombre_persona.value.length >= 3)
  {
      $("#avisolargolargo").hide('slow');
      document.formusuarios.nombre_persona.style.border = "1px solid #17dd37";
  }
}

function ValidarLargoApellido()
{
  if (document.formusuarios.apellidos_persona.value.length < 3)
  {
      $("#avisolargoapellido").show('slow');
      document.formusuarios.apellidos_persona.style.border = "1px solid #f22012";
  }

  if(document.formusuarios.apellidos_persona.value.length >= 3)
  {
      $("#avisolargoapellido").hide('slow');
      document.formusuarios.apellidos_persona.style.border = "1px solid #17dd37";
  }
}

function ValidarNombreUsuarioLargo()
{
  var user_name = document.formusuarios.nombre_usuario.value;
  if (user_name.length < 3)
  {
      $("#avisolargo").show('slow');
      document.formusuarios.nombre_usuario.style.border = "1px solid #f22012";
  }

  else {
    $("#avisolargo").hide('slow');
    document.formusuarios.nombre_usuario.style.border = "1px solid #17dd37";

  }
}

function validarCorreoUsuario()
{
  var correo = document.formusuarios.correo_user.value;
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (expr.test(correo))
  {
      document.formusuarios.correo_user.style.border = "1px solid  #17dd37";
      $("#avisomailformato").hide('fast');
      return true;
  }
  else
  {
    document.formusuarios.correo_user.style.border = "1px solid #f22012";
    $("#avisomailformato").show('slow');
    return false;
  }
}

function validarPassword()
{
  var pass_larga = true;
  var no_tiene_espacio = true;
  var tiene_numero = false;
  var password = document.formusuarios.pass.value;
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
    document.formusuarios.pass.style.border ="1px solid #f22012";
    $("#avisopassword").show('slow');
    return false;
  }
  else
  {
    $("#avisopassword").hide('slow');
    document.formusuarios.pass.style.border = "1px solid #17dd37";
    return true;
  }
}

function ValidarRepeatPassword()
{
  if(document.formusuarios.pass.value != document.formusuarios.repeat_pass.value)
  {
    document.formusuarios.repeat_pass.style.border = "1px solid #f22012";
    $("#avisopasswordrepeat").show('slow');
    return false;
  }
  else
  {
    document.formusuarios.repeat_pass.style.border = "1px solid ##17dd37";
    $("#avisopasswordrepeat").hide('fast');
    return true;
  }
}


function ValidarFormularioUsuarios()
{
    if (document.formusuarios.nombre_usuario.value == "")
    {
        $("#avisonombreusuario").show('slow');
        document.formusuarios.nombre_usuario.style.border = "1px solid #f22012";
    }

    if (document.formusuarios.nombre_usuario.value != "")
    {
        $("#avisonombreusuario").hide('fast');
        document.formusuarios.nombre_usuario.style.border = "1px solid #17dd37";
    }

    if (document.formusuarios.correo_user.value == "")
    {
        $("#avisocorreousuario").show('slow');
        document.formusuarios.correo_user.style.border = "1px solid #f22012";
    }

    if (document.formusuarios.correo_user.value != "")
    {
        $("#avisocorreousuario").hide('fast');
        document.formusuarios.correo_user.style.border = "1px solid #17dd37";
    }

    if (document.formusuarios.rol.value == "")
    {
        $("#avisorol").show('slow');
        document.formusuarios.rol.style.border = "1px solid #f22012";
    }

    if (document.formusuarios.rol.value != "")
    {
        $("#avisorol").hide('fast');
        document.formusuarios.rol.style.border = "1px solid #17dd37";
    }

    if (document.formusuarios.pass.value == "")
    {
        $("#avisopasword").show('slow');
        document.formusuarios.pass.style.border = "1px solid #f22012";
    }

    if (document.formusuarios.pass.value != "")
    {
        $("#avisopasword").hide('fast');
        document.formusuarios.pass.style.border = "1px solid #17dd37";
    }

    if (document.formusuarios.repeat_pass.value == "")
    {
        $("#avisopass2").show('slow');
        document.formusuarios.repeat_pass.style.border = "1px solid #f22012";
    }

    if (document.formusuarios.repeat_pass.value != "")
    {
        $("#avisopass2").hide('fast');
        document.formusuarios.repeat_pass.style.border = "1px solid #17dd37";
    }

    if (document.formusuarios.nombre_usuario.value != "" &&
        document.formusuarios.correo_user.value != "" &&
        document.formusuarios.rol.value != "" &&
        document.formusuarios.pass.value != "" &&
        document.formusuarios.repeat_pass.value != "")
    {

        var formData = new FormData($("#form-usuarios")[0]);

        var nombres = document.formusuarios.nombre_persona.value;
        var apellidos = document.formusuarios.apellidos_persona.value;
        var fecha = document.formusuarios.fecha.value;
        var nombre_usuario = document.formusuarios.nombre_usuario.value;
        var correo = document.formusuarios.correo_user.value;
        var rol = document.formusuarios.rol.value;
        var pass1 = document.formusuarios.pass.value;
        var pass2 = document.formusuarios.repeat_pass.value;
        var foto = document.formusuarios.image_perfil.value;

        $.ajax({
          url: url + 'usuarios/GuardarUsuarios',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#errorimagen").hide('fast');
            $("#nombre_productorepetido").hide('fast');
            $("#exito").hide('fast');
            $("#carga").show("fast");
          },
          success: function(resp){

            if (resp == "exito") {
              $("#carga").hide("fast");
              $("#nombre_productorepetido").hide('slow');
              $("#exito").show('slow');
              document.formproductos.nombre_producto.value = "";
              document.formproductos.precio.value = "";
              document.formproductos.descripcion.value = "";
              document.formproductos.dcto.value = 0;
              document.formproductos.optcolores.value = "";
              document.formproductos.cantidadcolor.value = "";
              document.formproductos.imagen1.value = "";
              document.formproductos.imagen2.value = "";
              document.formproductos.imagen3.value = "";
            }

            if (resp == "nombre_productorepetido") {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#nombre_productorepetido").show('slow');
              document.formproductos.nombre_producto.style.border = "1px solid #f22012";
              $('#nombre_producto').focus();
            }

            if (resp == "errorimagen") {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#nombre_productorepetido").hide('fast');
              $("#errorimagen").show('slow');
            }
          }
        });
    }
}
