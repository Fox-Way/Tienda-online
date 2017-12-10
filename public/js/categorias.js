

$(document).ready(function(){
    $('#table-categories').DataTable({
      "ordering": false,
    });
    $('#table-categories').DataTable();
  });


function ValidarLargoCategoria()
{
    var cate = $('#nombrecategoria').val();

    if (cate.length < 5) {
      $('#nombrecategoria').css('border', '1px solid #f22012');
      $("#avisocategorialargo").show("slow");
      return false;
    }else{
      $('#nombrecategoria').css('border', '1px solid #17dd37');
      $("#avisocategorialargo").hide("fast");
      return true;
    }
}

function ValidarFormularioCategoria()
{
    if (document.formcategories.nombrecategoria.value == "")
    {
        $("#avisonombre").show('slow');
        document.formcategories.nombrecategoria.style.border = "1px solid #f22012";
    }


    if (document.formcategories.nombrecategoria.value != "")
    {
        document.formcategories.nombrecategoria.style.border = "1px solid #17dd37";
        $("#avisonombre").hide('fast');
    }


    if (document.formcategories.nombrecategoria.value != "")
    {

        var formData = new FormData($("#form-categories")[0]);

        var nombre_categoria = document.formcategories.nombrecategoria.value;

        $.ajax({
          url: url + 'categorias/GuardarCategorias',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#nombrecategoriarepetido").hide('fast');
            $("#exitocategoria").hide('fast');
            $("#cargardatos").show("fast");
          },
          success: function(resp){

            if (resp == 1) {
              $("#cargardatos").hide("fast");
              $("#nombrecategoriarepetido").hide('slow');
              $("#exitocategoria").show('slow');
              document.formcategories.nombrecategoria.value = "";
            }

            if (resp == 2) {
              $("#cargardatos").hide("fast");
              $("#exitocategoria").hide('slow');
              $("#nombrecategoriarepetido").show('slow');
              document.formcategories.nombrecategoria.style.border = "1px solid #f22012";
            }
          }
        });
    }
}


  function Edicion(id){
    $.ajax({
      url: url + 'categorias/CargarDatos',
      type: 'POST',
      dataType: 'json',
      data: {'idcategoria' : id}
    }).done(function(resp){
        $('#categoria-edicion').val(resp.nombre);
        $('#id-categoria').val(resp.id);
    });
  }


  function EditarDatosCategoria()
  {
    $('#btn-editar').hide('slow');
    $('#btn-actualizar').show('slow');
    $('.obligatorio').show('slow');
    $('#categoria-edicion').removeAttr('readonly');
  }

  function ValidarLargoNombre()
  {
    var nombre = $('#categoria-edicion').val();

    if (nombre.length < 3) {
      $("#avisolargocateg").show('slow');
      $('#categoria-edicion').css('border', '1px solid #f22012');
    } else {
      $('#categoria-edicion').css('border', '1px solid #17dd37');
      $("#avisolargocateg").hide("fast");
      return true;
    }
  }

  function Limpiar()
  {
    $('#btn-editar').show('slow');
    $('#btn-actualizar').hide('slow');
    $('.obligatorio').hide('slow');
    $('#categoria-edicion').attr('readonly', true);
    $('#categoria-edicion').css('border', '1px solid #F1F1F1');
    $('#avisocateg').hide('fast');
    $("#nombrerepetido").hide('fast');
    $("#success").hide('fast');
    $("#cargar").hide('fast');
    $("#avisolargocateg").hide('fast');
  }

  function ValidarDatosCategoria()
  {
      if (document.formeditproducts.categoria_edicion.value == "")
      {
          $("#avisocateg").show('slow');
          document.formeditproducts.categoria_edicion.style.border = "1px solid #f22012";
          $("#categoria-edicion").focus();
      }

      if (document.formeditproducts.categoria_edicion.value != "")
      {
          $("#avisocateg").hide('fast');
          document.formeditproducts.categoria_edicion.style.border = "1px solid #17dd37";
      }

      if (document.formeditproducts.categoria_edicion.value != "" &&
          document.formeditproducts.idcategoria.value != "")
      {
          var formData = new FormData($("#form-edit-products")[0]);

          var nombre = document.formeditproducts.categoria_edicion.value;
          var id = document.formeditproducts.idcategoria.value;

          $.ajax({
            url: url + 'categorias/ActualizarCategoria',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
              $("#nombrerepetido").hide('fast');
              $("#success").hide('fast');
              $("#cargar").show("fast");
            },
            success: function(resp){

              if (resp == 3) {
                $("#cargar").hide("fast");
                $("#nombrerepetido").hide('slow');
                $("#success").show('slow');
              }

              if (resp == 4) {
                $("#cargar").hide("fast");
                $("#success").hide('slow');
                $("#nombrerepetido").show('slow');
                $('#categoria-edicion').css('border', '1px solid #f22012');
                $('#categoria-edicion').focus();
              }
            }
          });
      }
  }

  function CambiarEstado(id)
  {

    swal({
        title: 'Realmente desea cambiar el estado de la categoría?',
        text: 'Recuerde que si cambia el estado de la categoría ' +
              'todos los productos que esten asociados a esta categoria '+
              'también serán afectados.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
      }).then(function () {

        $.ajax({
          url: url + 'categorias/CambiarEstado',
          type: 'POST',
          data: {'idcategoria': id },
          beforeSend: function(){
            $("#cargando").show("slow");
            $('#cambioestado').hide('fast');
          },
          success: function(resp){

            if (resp == 1) {
                $('#cambioestado').show('slow');
                $("#cargando").hide("fast");
            }
          }
        });
      });
  }
