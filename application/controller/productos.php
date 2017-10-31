<?php

    class Productos extends Controller
    {

      private $mdlProductos;
      private $mdlImagenes;
      private $mdlColores;
      private $mdlCategorias;
      private $mdlMarcas;

      public function __construct()
      {
        $this->mdlProductos = $this->LoadModel('mdlProductos');
        $this->mdlImagenes = $this->LoadModel('mdlImagenes');
        $this->mdlColores = $this->LoadModel('mdlColores');
        $this->mdlCategorias = $this->LoadModel('mdlCategorias');
        $this->mdlMarcas = $this->LoadModel('mdlMarcas');
      }

      public function DetallesProducto()
      {

          if (isset($_GET['id_producto']))
          {
            $this->mdlProductos->__SET('id', $_GET['id_producto']);
            $producto = $this->mdlProductos->ConsultarProductoPorId();

            $this->mdlProductos->__SET('id', $_GET['id_producto']);
            $estado = $this->mdlProductos->ConsultarEstadoProductoPorId();

            if ($producto[0]['nombre'] != '' && $estado[0]['inicio'] != 0)
            {
                $this->mdlMarcas->__SET('idProducto',  $_GET['id_producto']);
                $marca = $this->mdlMarcas->ConsultarMarcasPorIdProducto();

                $categoria = $producto[0]['id_categoria'];
                $this->mdlCategorias->__SET('idCategoria', $categoria);
                $categoriaProducto = $this->mdlCategorias->ConsultarCategoriaPorId();

                $this->mdlImagenes->__SET('idProducto', $_GET['id_producto']);
                $imagenes1 = $this->mdlImagenes->ConsultarImagenPorIdProducto();

                $this->mdlImagenes->__SET('idProducto', $_GET['id_producto']);
                $imagenes2 = $this->mdlImagenes->ConsultarImagenPrioridad2();

                $this->mdlImagenes->__SET('idProducto', $_GET['id_producto']);
                $imagenes3 = $this->mdlImagenes->ConsultarImagenPrioridad3();

                $this->mdlColores->__SET('idProducto', $_GET['id_producto']);
                $colores = $this->mdlColores->consultarColoresPorIdProducto();

                // load views
                require APP . 'view/_templates/header.php';
                require APP . 'view/productos/detallesProductos.php';
                require APP . 'view/_templates/footer.php';
            }
            else
            {
              header('location:' . URL . 'home/Index');
              exit;
            }
          }
          else
          {
            header('location:' . URL . 'home/Index');
            exit;
          }
      }

      public function GuardarProducto()
      {
        if (isset($_SESSION['SESION_INICIADA']) &&
         $_SESSION['SESION_INICIADA'] == true)
         {

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

            $this->mdlColores->guardarDetallesColor();

            //GUardar tabla detalles marcas
              $this->mdlMarcas->__SET('idProducto', $ultimo_id[0]['id']);
              $this->mdlMarcas->__SET('idMarca', $_POST['marca']);

              $resultado = $this->mdlMarcas->GuardarDetallesMarca();

            //Guardar tabla imágenes
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

          //Consultar marca del producto
          $this->mdlMarcas->__SET('idProducto', $_POST['idproducto']);
          $marca = $this->mdlMarcas->ConsultarMarcasPorIdProducto();


          foreach ($producto as $prod) {

            $id = $prod['id_categoria'];

            //Seleccionar categoria del producto
            $this->mdlCategorias->__SET('idCategoria', $id);

            $categoria = $this->mdlCategorias->ConsultarCategoriaPorId();

            //Seleccionar la imágen del producto
            $this->mdlImagenes->__SET('idProducto', $prod['id']);

            $imagen1 = $this->mdlImagenes->ConsultarImagenPorIdProducto();
            $imagen2 =  $this->mdlImagenes->ConsultarImagenPrioridad2();
            $imagen3 =  $this->mdlImagenes->ConsultarImagenPrioridad3();
          }

          if ($imagen1 != 0)
          {
            $img1 = "";
            foreach ($imagen1 as $val) {
                $img1 .= "<br>";
                $img1 .= "Imágen " . $val['prioridad'] ." &nbsp;&nbsp;&nbsp";
                $img1 .= "<img width='80' src='" . URL . "/img/images-productos/" . $val['nombre'] . "' alt='" . $val['nombre'] . "'>";
                $img1 .= "<br><br>";
            }
          }


          if ($imagen2 != 0)
          {
            $img2 = "";
            foreach ($imagen2 as $val2) {
                $img2 .= "<br>";
                $img2 .= "Imágen " . $val2['prioridad'] ."&nbsp;&nbsp;&nbsp";
                $img2 .= "<img width='80' src='" . URL . "/img/images-productos/" . $val2['nombre']."' alt='" . $val2['nombre'] . "'>";
                $img2 .= "<br><br>";
            }
          }

          if ($imagen3 != 0)
          {
            $img3 = "";
            foreach ($imagen3 as $val3) {
                $img3 .= "<br>";
                $img3 .= "Imágen " . $val3['prioridad'] ."&nbsp;&nbsp;&nbsp";
                $img3 .= "<img width='80' src='" . URL . "/img/images-productos/" . $val3['nombre']."' alt='" . $val3['nombre'] . "'>";
                $img3 .= "<br><br>";
            }
          }

          echo json_encode([
            'nombre' => $prod['nombre'],
            'id' => $prod['id'],
            'precio' => $prod['precio'],
            'precio2' => "$ " . number_format($prod['precio2'], 0, '.', '.'),
            'descuento' => $prod['descuento'],
            'categoria' => $categoria[0]['nombre'],
            'imagen1' => $img1,
            'imagen2' => $img2,
            'imagen3' => $img3,
            'descripcion' => $prod['descripcion'],
            'marca' => $marca[0]['marca']
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

          $this->mdlProductos->__SET('id', $_POST['idproducto']);
          $this->mdlProductos->__SET('nombre', $_POST['nombre']);

          $productos = $this->mdlProductos->ConsultarProductos();

          if(intval($productos[0]['nombre']) == 0)
          {
              //Actualizar tabla productos
              $this->mdlProductos->__SET('id', $_POST['idproducto']);
              $this->mdlProductos->__SET('nombre', $_POST['nombre']);
              $this->mdlProductos->__SET('precio', $_POST['precio']);
              $this->mdlProductos->__SET('descuento', $_POST['dcto']);
              $this->mdlProductos->__SET('descripcion', $_POST['descripcion']);

              $this->mdlProductos->ActualizarProductos();
              echo 'exito';
          }
          else{
            echo "nombre_productorepetido";
          }
        }
      }
    }
 ?>
