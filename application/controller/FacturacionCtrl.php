<?php

use Dompdf\Dompdf;

class FacturacionCtrl extends Controller
{
  private $model;

  function __construct()
  {
    try {
      $this->model = $this->loadModel('mdlFacturacion');
    } catch (Exception $e) {
        return $e->getMessage();
    }

  }

  public function CrearFactura()
  {
    require APP.'view/_templates/header.php';
    require APP.'view/Facturacion/Facturacion.php';
    require APP.'view/_templates/footer.php';
  }

  public function guardarFactura()
  {
    require_once APP . 'libs/fpdf/fpdf.php';

    if (isset($_POST['btn-factura'])) {
      // $id_usuario = $this->model->consultar_id_usuario();
      $this->model->__SET('nombre', $_POST['nombre']);
      $this->model->__SET('telefono', $_POST['telefono']);
      $this->model->__SET('direccion', $_POST['direccion']);
      $save_user = $this->model->guardarEncabezadoFactura();

      $this->model->__SET('nombre_producto', $_POST['producto']);
      $this->model->__SET('cantidad', $_POST['cantidad']);
      $this->model->__SET('valor', $_POST['valor']);
      $save_producto = $this->model->guardarProducto();

      if ($save_user && $save_producto) {

          $ultimo_id_persona = $this->model->ultimoIdPersona();
          $ultimo_id_producto = $this->model->ultimoIdProducto();

          foreach ($ultimo_id_persona as $val) {
            $id_persona = $val['id_persona'];
            $this->model->__SET('id_persona', $id_persona);
          }

          foreach ($ultimo_id_producto as $value) {
            $id_producto = $value['id_producto'];
            $this->model->__SET('id_producto', $id_producto);
          }

          $this->model->__SET('estado', 1);

          $save_factura = $this->model->guardarFactura();

          if ($save_factura) {
            // header("Location:".URL."FacturacionCtrl/CrearFactura?success=ok");
            header("Location:".URL."FacturacionCtrl/Factura");
            exit();
          }
      }
    }
  }

  public function generarFactura()
  {
    require APP.'view/_templates/header.php';
    require APP.'view/Facturacion/generarFactura.php';
    require APP.'view/_templates/footer.php';
  }

  public function Factura()
  {
    require_once APP . 'libs/dompdf/autoload.inc.php';

    $nombre_persona = $this->model->nombrePersona();

    foreach ($nombre_persona as $nombre) {
      $nombre_p = $nombre['nombre_persona'];
      $this->model->__SET('nombre', $nombre_p);
    }

    $factura = $this->model->datosFactura();

    foreach ($factura as $value){
      $value['fecha'];
      $value['id_factura'];
      $value['nombre_persona'];
      $value['telefono'];
      $value['direccion'];
      $value['nombre_producto'];
      $value['cantidad'];
      $value['valor'];
      $value['valor_final'];
    }
    ob_start();
    require APP . 'view/Facturacion/pdfFacturacion.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper([0,0,310,500], 'portrait');
    $dompdf->render();
    $dompdf->stream("Informe Créditos.pdf", array("Attachment" => false, 'isRemoteEnabled' => true));
  }

  public function crearAbonoFactura()
  {
    $factura = $this->model->consultarFactura();

    $ids_persona = $this->model->consultarIdsPersona();

    require APP.'view/_templates/header.php';
    require APP.'view/Facturacion/abonosFactura.php';
    require APP.'view/_templates/footer.php';
  }

  public function guardarAbono()
  {
    if(isset($_POST['btnRegistrarAbono']))
    {
      $this->model->__SET('valor', $_POST['txtvalorabono']);
      $this->model->__SET('estado', 1);
      $this->model->__SET('id_persona', $_POST['idpersona']);
      $this->model->__SET('id_factura', $_POST['idfactura']);
      $save_abono = $this->model->guardarAbonoFactura();

      if($save_abono)
      {
        // $valor_restante = $this->Model->consultarSaldo();

        header("Location:".URL."FacturacionCtrl/CrearAbonoFactura?success=ok");
        exit();
      }else{
        header("Location:".URL."FacturacionCtrl/CrearAbonoFactura?error=fallo");
        exit();
      }

    }
  }
}
