<?php

class mdlFacturacion
{

  private $id_producto;
  private $id_persona;
  private $nombre_producto;
  private $nombre;
  private $telefono;
  private $direccion;
  private $cantidad;
  private $valor;
  private $fecha;
  private $id_factura;
  private $estado;
  private $db;

  public function __SET($attribute, $value)
  {
    $this->$attribute = $value;
  }

  public function __GET($attribute)
  {
    return $this->$attribute;
  }

  function __construct($db)
  {
    try {
      $this->db = $db;
    } catch (Exception $e) {
        return $e->getMessage();
    }

  }

  public function guardarProducto()
  {
    $sql = "CALL SP_guardar_producto(?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombre_producto);
    $stm->bindParam(2, $this->cantidad);
    $stm->bindParam(3, $this->valor);
    return $stm->execute();
  }

  public function guardarEncabezadoFactura()
  {
    $sql = "CALL SP_guardar_encabezado(?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombre);
    $stm->bindParam(2, $this->telefono);
    $stm->bindParam(3, $this->direccion);
    return $stm->execute();
  }

  public function datosFactura()
  {
    $sql = "CALL SP_datos_factura(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombre);
    $stm->execute();
    return $stm->fetchAll(2);
  }

  public function ultimoIdPersona()
  {
    $sql = "CALL SP_ultimo_id_persona()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(2);
  }

  public function ultimoIdProducto()
  {
    $sql = "CALL SP_ultimo_id_producto()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function nombrePersona()
  {
    $sql = "CALL SP_nombre_persona()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function guardarFactura()
  {
    $sql = "CALL SP_guardar_factura(?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->id_persona);
    $stm->bindParam(2, $this->id_producto);
    $stm->bindParam(3, $this->estado);
    return $stm->execute();
  }

  public function guardarAbonoFactura()
  {
    $sql = "CALL SP_guardar_abono_factura(?,?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->valor);
    $stm->bindParam(2, $this->estado);
    $stm->bindParam(3, $this->id_persona);
    $stm->bindParam(4, $this->id_factura);
    return $stm->execute();
  }

  public function consultarFactura()
  {
    $sql = "CALL SP_consultar_facturas()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(2);
  }

  public function consultarIdsPersona()
  {
    $sql = "CALL SP_consultar_ids_personas()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(2);
  }

  // public function consultarSaldo()
  // {
  //   $sql = "CALL SP_consultar_saldo()";
  //   $stm = $this->db->prepare($sql);
  //   $stm->execute();
  //   return $stm->fetchAll(2);
  // }
}
