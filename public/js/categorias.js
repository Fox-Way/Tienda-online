
function ValidarCategoria()
{
    var cate = $('#categoria').val();

    if (cate.length < 5) {
      $('#categoria').css('border', '1px solid #f22012');
      $("#avisocategoria").show("slow");
      return false;
    }else{
      $('#categoria').css('border', '1px solid #17dd37');
      $("#avisocategoria").hide("fast");
      return true;
    }
}


  document.getElementById('btn-categoria').onclick = function(){
      var connect, cate, form, result;
      cate = document.getElementById('categoria').value;

      if (cate != '') {
        form = 'cate=' + cate;

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
                window.location = url + 'administracion/Categorias';
              }else{
                //Error: nombre ya existe
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Error! </strong>El nombre ingresado ya existe';
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
        connect.open('POST', url + 'categorias/GuardarCategorias', true);
        connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        connect.send(form);
      }else{
        //Mostrar error de datos vacíos
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<center><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp';
        result += 'Error! </strong>Debes llenar todos los campos con <span class="red">*</span> obligatoriamente</center>';
        result += '</div>';
        document.getElementById('categoria').style.border = '1px solid #f22012';
        document.getElementById('_AJAX_').innerHTML = result;
      }
  }
