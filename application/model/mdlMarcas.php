<?php

    class mdlMarcas
    {

      private $idMarca;
      private $marca;
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

      public function ConsultarMarcas()
      {
        $sql = "CAll SP_consultarMarcas()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarMarcasPorIdProducto()
      {
        $sql = "CAll SP_consultarMarcasPorIdProducto(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function GuardarDetallesMarca()
      {
        $sql = "CAll SP_guardarDetallesMarca(?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $stm->bindParam(2, $this->idMarca);
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

      public function EliminarDetallesMarcas()
      {
        $sql = "CAll SP_eliminarDetallesMarcas(?)";

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $result = $stm->execute();
          return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      }
    }
 ?>
