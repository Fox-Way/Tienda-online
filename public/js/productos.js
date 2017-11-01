

function ValidarFormulario()
{
    if (document.formproductos.nombre_producto.value == "")
    {
        $("#avisonombre").show('slow');
        document.formproductos.nombre_producto.style.border = "1px solid #f22012";
    }

    if (document.formproductos.precio.value == "")
    {
        $("#avisoprecio").show('slow');
        document.formproductos.precio.style.border = "1px solid #f22012";
    }

    if (document.formproductos.dcto.value != "")
    {
        document.formproductos.dcto.style.border = "1px solid #17dd37";
    }

    if (document.formproductos.categoria.value == "")
    {
        $("#avisocategoria").show('slow');
        document.formproductos.categoria.style.border = "1px solid #f22012";
    }

    if (document.formproductos.marca.value == "")
    {
        $("#avisomarca").show('slow');
        document.formproductos.marca.style.border = "1px solid #f22012";
    }

    if (document.formproductos.optcolores.value == "")
    {
        $("#avisocolores").show('slow');
        document.formproductos.optcolores.style.border = "1px solid #f22012";
    }

    if (document.formproductos.cantidadcolor.value == "")
    {
        $("#avisocantcolor").show('slow');
        document.formproductos.cantidadcolor.style.border = "1px solid #f22012";
    }

    if (document.formproductos.imagen1.value == "")
    {
        $("#avisoimagenrequerida").show('slow');
        document.formproductos.imagen1.style.border = "1px solid #f22012";
    }

    if (document.formproductos.nombre_producto.value != "" &&
        document.formproductos.precio.value != "" &&
        document.formproductos.categoria.value != "" &&
        document.formproductos.marca.value != "" &&
        document.formproductos.optcolores.value != "" &&
        document.formproductos.cantidadcolor.value != "")
    {

        var formData = new FormData($("#form-productos")[0]);

        var nombre_producto = document.formproductos.nombre_producto.value;
        var precio = document.formproductos.precio.value;
        var dcto = document.formproductos.dcto.value;
        var descripcion = document.formproductos.descripcion.value;
        var categoria = document.formproductos.categoria.value;
        var marca = document.formproductos.marca.value;
        var color = document.formproductos.optcolores.value;
        var cantidad_color = document.formproductos.cantidadcolor.value;
        var imagen1 = document.formproductos.imagen1.value;

        $.ajax({
          url: url + 'productos/GuardarProducto',
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

function ValidarNombre()
{
  if (document.formproductos.nombre_producto.value.length < 5)
  {
      $("#avisonombrelargo").show('slow');
      document.formproductos.nombre_producto.style.border = "1px solid #f22012";
  }

  if(document.formproductos.nombre_producto.value.length >= 5)
  {
      $("#avisonombrelargo").hide('slow');
      document.formproductos.nombre_producto.style.border = "1px solid #17dd37";
  }

  if(document.formproductos.nombre_producto.value != "")
  {
    $("#avisonombre").hide('slow');
    document.formproductos.nombre_producto.style.border = "1px solid #17dd37";
  }
}

function ValidarCategoria()
{
  if (document.formproductos.categoria.value != "")
  {
      $("#avisocategoria").hide('slow');
      document.formproductos.categoria.style.border = "1px solid #17dd37";
  }
}

function ValidarMarca()
{
  if (document.formproductos.marca.value != "")
  {
      $("#avisomarca").hide('slow');
      document.formproductos.marca.style.border = "1px solid #17dd37";
  }
}


function ValidarImagen()
{
  if (document.formproductos.imagen1.value != "")
  {
      $("#avisoimagenrequerida").hide('slow');
      document.formproductos.imagen1.style.border = "1px solid #17dd37";
  }
}

function ValidarColor()
{
  if (document.formproductos.optcolores.value != "")
  {
      $("#avisocolores").hide('slow');
      document.formproductos.optcolores.style.border = "1px solid #17dd37";
  }
}


function ValidarCantidadColor()
{
  if(document.formproductos.cantidadcolor.value != "")
  {
    $("#avisocantcolor").hide('slow');
    document.formproductos.cantidadcolor.style.border = "1px solid #17dd37";
  }
}


function ValidarPrecio()
{
  if(document.formproductos.precio.value != "")
  {
    $("#avisoprecio").hide('slow');
    document.formproductos.precio.style.border = "1px solid #17dd37";
  }
}

function ValidarDescuento()
{
  if(document.formproductos.dcto.value > 100)
  {
    $("#avisodescuento").show('slow');
    document.formproductos.dcto.style.border = "1px solid #f22012";
  }

  if(document.formproductos.dcto.value <= 100)
  {
    $("#avisodescuento").hide('slow');
    document.formproductos.dcto.style.border = "1px solid #17dd37";
  }
}

function mostrar()
{
  $("#imagenes").toggle('slow');
}

function mostrarCamposColores()
{
  $("#colores").toggle('slow');
}

function Ventana(id){
  $.ajax({
    url: url + 'productos/VerProducto',
    type: 'POST',
    dataType: 'json',
    data: {'idproducto' : id}
  }).done(function(resp){
      $('#nombre').val(resp.nombre);
      $('#id-producto').val(resp.id);
      $('#precio').val(resp.precio);
      $('#price-dcto').val(resp.precio2);
      $('#dcto').val(resp.descuento);
      $('#categoria').val(resp.categoria);
      $('#imagen1').html(resp.imagen1);
      $('#imagen2').html(resp.imagen2);
      $('#imagen3').html(resp.imagen3);
      $('#descripcion').html(resp.descripcion);
      $('#marca').val(resp.marca);
  });
}

function EditarDatos()
{

  $('#btn-editar').hide('slow');
  $('#btn-actualizar').show('slow');
  $('.obligatorio').show('slow');
  $('#nombre').removeAttr('readonly');
  $('#precio').removeAttr('readonly');
  $('#dcto').removeAttr('readonly');
  $('#descripcion').removeAttr('readonly');
}

function Recargar()
{
  $('#btn-editar').show('slow');
  $('#btn-actualizar').hide('slow');
  $('.obligatorio').hide('slow');
  $('#nombre').attr('readonly', true);
  $('#nombre').css('border', 'none');
  $('#precio').attr('readonly', true);
  $('#precio').css('border', 'none');
  $('#dcto').attr('readonly', true);
  $('#dcto').css('border', 'none');
  $('#descripcion').attr('readonly', true);
  $('#descripcion').css('border', 'none');
  $('#avisocampos').hide('fast');
  $("#nombre_productorepetido").hide('fast');
  $("#exito").hide('fast');
  $('#errorimagen').hide('fast');
}

function ValidarDatos()
{
    if (document.formdetailsproducts.nombre.value == "")
    {
        $("#avisocampos").show('slow');
        document.formdetailsproducts.nombre.style.border = "1px solid #f22012";
        $("#nombre").focus();
    }

    if (document.formdetailsproducts.precio.value == "")
    {
        $("#avisocampos").show('slow');
        document.formdetailsproducts.precio.style.border = "1px solid #f22012";
        $("#precio").focus();
    }

    if (document.formdetailsproducts.dcto.value == "")
    {
        $("#avisocampos").show('slow');
        document.formdetailsproducts.dcto.style.border = "1px solid #f22012";
        $("#dcto").focus();
    }


    if (document.formdetailsproducts.nombre.value != "" &&
        document.formdetailsproducts.precio.value != "" &&
        document.formdetailsproducts.dcto.value != "")
    {

        var formData = new FormData($("#form-details-products")[0]);

        var nombre = document.formdetailsproducts.nombre.value;
        var precio = document.formdetailsproducts.precio.value;
        var dcto = document.formdetailsproducts.dcto.value;
        var descripcion = document.formdetailsproducts.descripcion.value;
        var idproducto = document.formdetailsproducts.idproducto.value;

        $.ajax({
          url: url + 'productos/ActualizarProductos',
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#nombre_productorepetido").hide('fast');
            $("#exito").hide('fast');
            $("#carga").show("fast");
          },
          success: function(resp){

            if (resp == "exito") {
              $("#carga").hide("fast");
              $("#nombre_productorepetido").hide('slow');
              $("#exito").show('slow');
            }

            if (resp == "nombre_productorepetido") {
              $("#carga").hide("fast");
              $("#exito").hide('slow');
              $("#nombre_productorepetido").show('slow');
              document.formdetailsproducts.nombre.style.border = "1px solid #f22012";
              $('#nombre').focus();
            }
          }
        });
    }
}

function EliminarProducto(id)
{

  swal({
      title: 'Realmente desea eliminar el produto?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar',
    }).then(function () {

      $.ajax({
        url: url + 'administracion/EliminarProducto',
        type: 'POST',
        data: {'idproducto': id },
        success: function(resp){

          if (resp == 1) {
              $('#eliminacioncorrecta').show('slow');
              $('#erroreliminacion').hide('fast');
          }

          if (resp == 2) {
              $('#erroreliminacion').show('slow');
              $('#eliminacioncorrecta').hide('fast');
          }
        }
      });
    });
}

function Enchufe(id)
{
  var name = document.getElementsByName(id);

  for (var i = 0; i < name.length; i++) {
    if (name[i].checked)
    {
        name = name[i].value;
    }
  }

  $.ajax({
    url: url + 'administracion/Interruptor',
    type: 'POST',
    data: {'id': id, 'interruptor': name},
    beforeSend: function(){
      $('#procesando').show('slow');
    },
    success: function(resp){

      if (resp == 'Producto activado correctamente') {
        $('#procesando').hide('fast');
        $('#activado').show('slow');
        $('#desactivado').hide('fast');
      }

      if (resp == 'Producto desactivado correctamente') {
        $('#procesando').hide('fast');
        $('#activado').hide('fast');
        $('#desactivado').show('slow');
      }
    }
  });
}

function MostrarDescripcion()
  {
      $("#texto").show(1000);
      $("#btn-mostrar").hide('slow');
      $("#btn-ocultar").show('slow');
      $("#more").hide('slow');
  }

  function OcultarDescripcion()
  {
      $("#texto").hide('fast');
      $("#btn-mostrar").show('slow');
      $("#btn-ocultar").hide('slow');
      $("#more").show('slow');

  }
