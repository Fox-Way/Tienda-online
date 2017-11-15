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
    document.formusuarios.repeat_pass.style.border = "1px solid #17dd37";
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
            $("#nombreusuarioemailrepetido").hide('fast');
            $("#exito").hide('fast');
            $("#carga").show("fast");
            $("#errorimagen").hide('fast');
          },
          success: function(resp){

            if (resp == 1) {
              $("#carga").hide("fast");
              $("#nombreusuarioemailrepetido").hide('slow');
              $("#exito").show('slow');
              $("#errorimagen").hide('fast');

              document.formusuarios.nombre_persona.value = "";
              document.formusuarios.apellidos_persona.value = "";
              document.formusuarios.fecha.value = "";
              document.formusuarios.nombre_usuario.value = "";
              document.formusuarios.correo_user.value = "";
              document.formusuarios.rol.value = "";
              document.formusuarios.pass.value = "";
              document.formusuarios.repeat_pass.value = "";
              document.formusuarios.image_perfil.value = "";
            }

            if (resp == 2) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#errorfecha").hide('fast');
              $("#nombreusuarioemailrepetido").show('slow');
              document.formusuarios.nombre_usuario.style.border = "1px solid #f22012";
              document.formusuarios.correo_user.style.border = "1px solid #f22012";
              $('#nombre_usuario').focus();
              $('#correo_usuario').focus();
            }

            if (resp == 3) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#nombreusuarioemailrepetido").hide('fast');
              $("#errorimagen").show('slow');
              $("#errorfecha").hide('fast');

            }

            if (resp == 4) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#nombreusuarioemailrepetido").hide('fast');
              $("#errorimagen").hide('fast');
              $("#errorfecha").show('slow');
            }
          }
        });
    }
}

// $('#fecha_details').datepicker({
//     autoclose: true
// });

function DetallesUsuario(id){
  $.ajax({
    url: url + 'usuarios/VerUsuarios',
    type: 'POST',
    dataType: 'json',
    data: {'idusuario' : id}
  }).done(function(resp){
      $('#nombres').val(resp.nombres);
      $('#apellidos').val(resp.apellidos);
      $('#fecha_details').val(resp.fecha);
      $('#name_user').val(resp.usuario);
      $('#email_details').val(resp.email);
      $('#id-user').val(resp.id);
      $('#rol_details').val(resp.rol);
  });
}

function EditarDatosUser()
{

  $('#btn-editar-user').hide('slow');
  $('#btn-actualizar-user').show('slow');
  $('.obligatorio').show('slow');
  $('#name_user').removeAttr('readonly');
  $('#email_details').removeAttr('readonly');
  $('#title-user').html('Edición de Usuarios');
}

function RecargarUser()
{
  $('#btn-editar-user').show('slow');
  $('#btn-actualizar-user').hide('slow');
  $('.obligatorio').hide('slow');
  $('#name_user').attr('readonly', true);
  $('#name_user').css('border', '1px solid #F1F1F1');
  $('#email_details').attr('readonly', true);
  $('#email_details').css('border', '1px solid #F1F1F1');
  $('#avisocampos').hide('fast');
  $('#title-user').html('Información del Usuario');
  $("#user_email_repetido").hide('fast');
  $("#exito").hide('fast');
}

function ValidarDatosUser()
{
    if (document.formdetailsusers.name_user.value == "")
    {
        $("#avisocampos").show('slow');
        document.formdetailsusers.name_user.style.border = "1px solid #f22012";
        $("#name_user").focus();
    }

    if (document.formdetailsusers.email_details.value == "")
    {
        $("#avisocampos").show('slow');
        document.formdetailsusers.email_details.style.border = "1px solid #f22012";
        $("#email_details").focus();
    }


    if (document.formdetailsusers.name_user.value != "" &&
        document.formdetailsusers.email_details.value != "")
    {

        var formData = new FormData($("#form-details-users")[0]);

        var usuario = document.formdetailsusers.name_user.value;
        var email = document.formdetailsusers.email_details.value;
        var idusuario = document.formdetailsusers.iduser.value;

        $.ajax({
          url: url + 'usuarios/ActualizarUsuarios',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#user_email_repetido").hide('fast');
            $("#exito").hide('fast');
            $("#carga").show("fast");
          },
          success: function(resp){

            if (resp == 1) {
              $("#carga").hide("fast");
              $("#user_email_repetido").hide('slow');
              $("#exito").show('slow');
            }

            if (resp == 2) {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#user_email_repetido").show('slow');
              document.formdetailsusers.name_user.style.border = "1px solid #f22012";
              document.formdetailsusers.email_details.style.border = "1px solid #f22012";
              $('#name_user').focus();
              $('#email_details').focus();
            }
          }
        });
    }
}

function CambiarEstadoUsuario(id)
{

  swal({
      title: 'Realmente desea cambiar el estado del usuario?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar',
    }).then(function () {

      $.ajax({
        url: url + 'usuarios/CambiarEstadoUsuario',
        type: 'POST',
        data: {'idusuario': id },
        beforeSend: function(){
          $("#cargandouser").show("slow");
          $('#cambioestadouser').hide('fast');
        },
        success: function(resp){

          if (resp == 1) {
              $('#cambioestadouser').show('slow');
              $("#cargandouser").hide("fast");
          }
        }
      });
    });
}
