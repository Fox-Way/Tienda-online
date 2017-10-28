<?php

    class mdlColores
    {

      private $idColor;
      private $color;
      private $codigoColor;
      private $cantidad;
      private $idProducto;
      private $db;

      public function __SET($attr, $valor)
      {
        $this->$attr = $valor;
      }

      public function __GET($attr)
      {
        return $this->$attr;
      }

      public function __construct($db)
      {
        try {
          $this->db = $db;
        } catch (PDOException $e) {
          exit('No se pudo establecer conexion con la base de datos');
        }
      }

      public function consultarColores()
      {
        $sql = "CAll SP_consultarColores()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function consultarColoresPorIdProducto()
      {
        $sql = "CAll SP_consultarColoresPorIdProducto(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function guardarDetallesColor()
      {
        $sql = "CAll SP_guardarDetallesColor(?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $stm->bindParam(2, $this->idColor);
          $stm->bindParam(3, $this->cantidad);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error en la inserción');
        }
      }
    }
 ?>
