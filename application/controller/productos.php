<?php

    class Productos extends Controller
    {

      private $mdlProductos;
      private $mdlImagenes;
      private $mdlColores;
      private $mdlCategorias;

      public function __construct()
      {
        $this->mdlProductos = $this->LoadModel('mdlProductos');
        $this->mdlImagenes = $this->LoadModel('mdlImagenes');
        $this->mdlColores = $this->LoadModel('mdlColores');
        $this->mdlCategorias = $this->LoadModel('mdlCategorias');
      }

      public function DetallesProducto()
      {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/productos/detallesProductos.php';
        require APP . 'view/_templates/footer.php';
      }

      public function GuardarProducto()
      {
        if (isset($_SESSION['SESION_INICIADA']) && $_SESSION['SESION_INICIADA'] == true) {
          sleep(2);

          $this->mdlProductos->__SET('nombre', $_POST['nombre_producto']);

          $productos = $this->mdlProductos->ConsultarProductosPorNombre();

          if (count($productos) == 0) {

            //Zona imágenes
            //Imágen 1

        if ($_FILES['imagen1']['name'] != "") {

          $ext = explode(".", $_FILES['imagen1']['name']);
          $extension = end($ext);
          $_FILES['imagen1']['name'] = time() . "_01." . $extension;

          $permitidos = array(
            "image/jpg",
            "image/jpeg",
            "image/gif",
            "image/png"
          );

          $limite_kb = 1000;

          if (in_array($_FILES['imagen1']['type'], $permitidos) &&
              $_FILES['imagen1']['size'] <= $limite_kb * 1024) {
              $ruta = 'C:/xampp/htdocs/Proyecto/public/img/images-productos/' . $_FILES['imagen1']['name'];
              $resultado = move_uploaded_file($_FILES['imagen1']['tmp_name'], $ruta);
          }else{
            echo "errorimagen";
            exit();
          }
        }

        //Imágen 2
        if ($_FILES['imagen2']['name'] != "") {

          $ext = explode(".", $_FILES['imagen2']['name']);
          $extension = end($ext);
          $_FILES['imagen2']['name'] = time() . "_02." . $extension;

          $permitidos = array(
            "image/jpg",
            "image/jpeg",
            "image/gif",
            "image/png"
          );

          $limite_kb = 1000;

          if (in_array($_FILES['imagen2']['type'], $permitidos) && $_FILES['imagen2']['size'] <= $limite_kb * 1024) {
            $ruta = 'C:/xampp/htdocs/Proyecto/public/img/images-productos/' . $_FILES['imagen2']['name'];
            $resultado = move_uploaded_file($_FILES['imagen2']['tmp_name'], $ruta);
          }else{
            echo "errorimagen";
            exit();
          }
        }

        //Imágen 3
        if ($_FILES['imagen3']['name'] != "") {

          $ext = explode(".", $_FILES['imagen3']['name']);
          $extension = end($ext);
          $_FILES['imagen3']['name'] = time() . "_03." . $extension;

          $permitidos = array(
            "image/jpg",
            "image/jpeg",
            "image/gif",
            "image/png"
          );

          $limite_kb = 1000;

          if (in_array($_FILES['imagen3']['type'], $permitidos) && $_FILES['imagen3']['size'] <= $limite_kb * 1024) {
            $ruta = 'C:/xampp/htdocs/Proyecto/public/img/images-productos/' . $_FILES['imagen3']['name'];
            $resultado = move_uploaded_file($_FILES['imagen3']['tmp_name'], $ruta);
          }else{
            echo "errorimagen";
            exit();
          }
        }

          //Guardar tabla productos
            $this->mdlProductos->__SET('nombre', $_POST['nombre_producto']);
            $this->mdlProductos->__SET('precio', $_POST['precio']);
            $this->mdlProductos->__SET('descuento', $_POST['dcto']);
            $this->mdlProductos->__SET('descripcion', $_POST['descripcion']);
            $this->mdlProductos->__SET('categoria', $_POST['categoria']);
            $this->mdlProductos->__SET('cantidad', 0);
            $this->mdlProductos->__SET('inicio', 0);

            $this->mdlProductos->GuardarProductos();

            $ultimo_id = $this->mdlProductos->consultarUltimoIdProducto();

            //Guardar tabla detalles colores
            $this->mdlColores->__SET('idProducto', $ultimo_id[0]['id']);
            $this->mdlColores->__SET('idColor', $_POST['optcolores']);
            $this->mdlColores->__SET('cantidad', $_POST['cantidadcolor']);

            $resultado = $this->mdlColores->guardarDetallesColor();

            if($_FILES['imagen1']['name'] != '')
            {
              $nombreImagen = $_FILES['imagen1']['name'];

              $this->mdlImagenes->__SET('nombre', $nombreImagen);
              $this->mdlImagenes->__SET('prioridad', 1);
              $this->mdlImagenes->__SET('idProducto', $ultimo_id[0]['id']);

              $this->mdlImagenes->guardarNombreImagen();
            }

            if($_FILES['imagen2']['name'] != '')
            {
              $nombreImagen = $_FILES['imagen2']['name'];

              $this->mdlImagenes->__SET('nombre', $nombreImagen);
              $this->mdlImagenes->__SET('prioridad', 2);
              $this->mdlImagenes->__SET('idProducto', $ultimo_id[0]['id']);

              $this->mdlImagenes->guardarNombreImagen();
            }

            if($_FILES['imagen3']['name'] != '')
            {
              $nombreImagen = $_FILES['imagen3']['name'];

              $this->mdlImagenes->__SET('nombre', $nombreImagen);
              $this->mdlImagenes->__SET('prioridad', 3);
              $this->mdlImagenes->__SET('idProducto', $ultimo_id[0]['id']);

              $this->mdlImagenes->guardarNombreImagen();
            }

            echo 'exito';
          }
          else{
            echo 'nombre_productorepetido';
          }
        }
        else{
          header('location:' . URL . 'administracion/IniciarSesion');
          exit();
        }
      }

      public function VerProducto()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
            $_SESSION['SESION_INICIADA'] == true)
        {

          //Seleccionar id del producto
          $this->mdlProductos->__SET('id', $_POST['idproducto']);

          $producto = $this->mdlProductos->ConsultarProductoPorId();

          foreach ($producto as $prod) {

            $id = $prod['id_categoria'];

            //Seleccionar categoria del producto
            $this->mdlCategorias->__SET('idCategoria', $id);

            $categoria = $this->mdlCategorias->ConsultarCategoriaPorId();

            //Seleccionar la imágen del producto
            $this->mdlImagenes->__SET('idProducto', $prod['id']);

            $imagen = $this->mdlImagenes->ConsultarImagenPorIdProducto();
          }

          if ($imagen != 0)
          {
            $img = "";
            foreach ($imagen as $val) {
                $img .= "<br>";
                $img .= $val['nombre'] . "&nbsp;&nbsp;&nbsp";
                $img .= "<img width='100' src='" . URL . "/img/images-productos/" . $val['nombre']."' alt='" . $val['nombre'] . "'>";
                $img .= '<input type="file" name="imagen" class="form-control obligatorio">';
                $img .= "<br><br>";
            }
          }

          echo json_encode([
            'nombre' => $prod['nombre'],
            'id' => $prod['id'],
            'precio' => $prod['precio'],
            'descuento' => $prod['descuento'],
            'categoria' => $categoria[0]['nombre'],
            'imagen' => $img,
            'descripcion' => $prod['descripcion']
          ]);

        }
        else {
          header('location:' . URL . 'administracion/IniciarSesion');
          exit();
        }
      }

      public function ActualizarProductos()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
            $_SESSION['SESION_INICIADA'] == true)
        {
          sleep(2);

          $this->mdlProductos->__SET('nombre', $_POST['nombre']);

          $productos = $this->mdlProductos->ConsultarProductosPorNombre();

          if(count($productos) == 0 && )
        }
      }
    }
 ?>
