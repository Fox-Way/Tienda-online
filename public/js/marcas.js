
function ValidarLargoMarca()
{
    var marca = $('#marca').val();

    if (marca.length < 3) {
      $('#marca').css('border', '1px solid #f22012');
      $("#avisomarcalargo").show("slow");
      return false;
    }else{
      $('#marca').css('border', '1px solid #17dd37');
      $("#avisomarcalargo").hide("fast");
      return true;
    }
}

function ValidarFormularioMarcas()
{
    if (document.formmarcas.marca.value == "")
    {
        $("#avisomarca").show('slow');
        document.formmarcas.marca.style.border = "1px solid #f22012";
    }


    if (document.formmarcas.marca.value != "")
    {
        document.formmarcas.marca.style.border = "1px solid #17dd37";
        $("#avisomarca").hide('fast');
    }


    if (document.formmarcas.marca.value != "")
    {

        var formData = new FormData($("#form-marcas")[0]);

        var marca = document.formmarcas.marca.value;

        $.ajax({
          url: url + 'marcas/GuardarMarcas',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#nombremarcarepetido").hide('fast');
            $("#exitomarca").hide('fast');
            $("#cargarmarca").show("fast");
          },
          success: function(resp){

            if (resp == 1) {
              $("#cargarmarca").hide("fast");
              $("#nombremarcarepetido").hide('slow');
              $("#exitomarca").show('slow');
              document.formmarcas.marca.value = "";
            }

            if (resp == 2) {
              $("#cargarmarca").hide("fast");
              $("#exitomarca").hide('slow');
              $("#nombremarcarepetido").show('slow');
              document.formmarcas.marca.style.border = "1px solid #f22012";
              $('#marca').focus();
            }
          }
        });
    }
}


  function EdicionMarca(id){
    $.ajax({
      url: url + 'marcas/CargarDatosMarcas',
      type: 'POST',
      dataType: 'json',
      data: {'idmarca' : id}
    }).done(function(resp){
        $('#marca-edicion').val(resp.marca);
        $('#id-marca').val(resp.idmarca);
    });
  }


  function EditarDatosMarca()
  {
    $('#btn-editarmarca').hide('slow');
    $('#btn-actualizarmarca').show('slow');
    $('.obligatorio').show('slow');
    $('#marca-edicion').removeAttr('readonly');
  }

  function ValidarLargoMarcaEdicion()
  {
    var marca = $('#marca-edicion').val();

    if (marca.length < 3) {
      $("#avisolargomarcaedicion").show('slow');
      $('#marca-edicion').css('border', '1px solid #f22012');
      return false;
    } else {
      $('#marca-edicion').css('border', '1px solid #17dd37');
      $("#avisolargomarcaedicion").hide("fast");
      return true;
    }
  }

  function LimpiarDatosMarca()
  {
    $('#btn-editarmarca').show('slow');
    $('#btn-actualizarmarca').hide('slow');
    $('.obligatorio').hide('slow');
    $('#marca-edicion').attr('readonly', true);
    $('#marca-edicion').css('border', 'none');
    $('#avisomarcaedicion').hide('fast');
    $("#nombremarcarepetido").hide('fast');
    $("#successmarca").hide('fast');
    $("#procesandodatosmarca").hide('fast');
    $("#avisolargomarcaedicion").hide('fast');
  }

  function ValidarDatosMarca()
  {
      if (document.formeditmarcas.marca_edicion.value == "")
      {
          $("#avisomarcaedicion").show('slow');
          document.formeditmarcas.marca_edicion.style.border = "1px solid #f22012";
          $("#marca-edicion").focus();
      }

      if (document.formeditmarcas.marca_edicion.value != "")
      {
          $("#avisomarcaedicion").hide('fast');
          document.formeditmarcas.marca_edicion.style.border = "1px solid #17dd37";
      }

      if (document.formeditmarcas.marca_edicion.value != "" &&
          document.formeditmarcas.idmarca.value != "")
      {
          var formData = new FormData($("#form-edit-marcas")[0]);

          var marca = document.formeditmarcas.marca_edicion.value;
          var id = document.formeditmarcas.idmarca.value;

          $.ajax({
            url: url + 'marcas/ActualizarMarcas',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
              $("#nombremarcarepetidoedicion").hide('fast');
              $("#successmarca").hide('fast');
              $("#procesandodatosmarca").show("fast");
            },
            success: function(resp){

              if (resp == 3) {
                $("#procesandodatosmarca").hide("fast");
                $("#nombremarcarepetidoedicion").hide('slow');
                $("#successmarca").show('slow');
              }

              if (resp == 4) {
                $("#procesandodatosmarca").hide("fast");
                $("#successmarca").hide('slow');
                $("#nombremarcarepetidoedicion").show('slow');
                $('#marca-edicion').css('border', '1px solid #f22012');
                $('#marca-edicion').focus();
              }
            }
          });
      }
  }

  function CambiarEstadoMarca(id)
  {

    swal({
        title: 'Realmente desea cambiar el estado de la marca?',
        text: 'Recuerde que si cambia el estado de la marca ' +
              'ya no podrá asociar productos a esa marca. ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
      }).then(function () {

        $.ajax({
          url: url + 'marcas/CambiarEstado',
          type: 'POST',
          data: {'idmarca': id },
          beforeSend: function(){
            $("#cargandoestadomarca").show("slow");
            $('#cambioestadomarca').hide('fast');
          },
          success: function(resp){

            if (resp == 1) {
                $('#cambioestadomarca').show('slow');
                $("#cargandoestadomarca").hide("fast");
            }
          }
        });
      });
  }
