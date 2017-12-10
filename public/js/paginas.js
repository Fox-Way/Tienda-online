  $(document).ready(function() {
    $("#paginas").keydown(function(e){
     if(e.which === 189 || e.which === 69){
       e.preventDefault();
     }
   });

  });



function CargarPaginas(id)
{
  $.ajax({
    url: url + 'productos/CargarDatosPaginas',
    type: 'POST',
    dataType: 'json',
    data: {'idpaginas' : id}
  }).done(function(resp){
      $('#paginas').val(resp.paginas);
      $('#idpagina').val(resp.id);
  });
}

function ValidarDatosNumeroPaginas()
{
    if (document.formeditpaginas.paginas.value == "")
    {
        $("#aviso_numero").show('slow');
        document.formeditpaginas.paginas.style.border = "1px solid #f22012";
    }

    if (document.formeditpaginas.paginas.value != "")
    {
        document.formeditpaginas.paginas.style.border = "1px solid #17dd37";
        $("#aviso_numero").hide('fast');
    }

    if (document.formeditpaginas.paginas.value <= 0)
    {
      $("#avisonumeroinvalido").show('slow');
      document.formeditpaginas.paginas.style.border = "1px solid #f22012";
    }

    else {
      $("#avisonumeroinvalido").hide('fast');
      document.formeditpaginas.paginas.style.border = "1px solid #17dd37";
    }

    if (document.formeditpaginas.paginas.value != "" &&
        document.formeditpaginas.paginas.value > 0)
    {
        var formData = new FormData($("#form-edit-paginas")[0]);

        var paginas = document.formeditpaginas.paginas.value;
        var idpaginas = document.formeditpaginas.idpagina.value;

        $.ajax({
          url: url + 'productos/ActualizarPaginas',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#aviso_numero").hide('fast');
            $("#successnumero").hide('fast');
            $("#procesandodatos").show("slow");
          },
          success: function(resp){

            if (resp == 1) {
              $("#procesandodatos").hide("fast");
              $("#aviso_numero").hide('slow');
              $("#successnumero").show('slow');
            }
          }
        });
    }
}

function LimpiarModal()
{
  $('#successnumero').hide('fast');
  $('#paginas').css('border', '1px solid #F1F1F1');
  $('#procesando').hide('fast');
  $('#avisonumeroinvalido').hide('fast');
  $('#aviso_numero').hide('fast');
}
