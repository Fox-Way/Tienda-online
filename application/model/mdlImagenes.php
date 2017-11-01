<?php

    class mdlImagenes
    {

      private $idImagen;
      private $nombre;
      private $prioridad;
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

      public function GuardarNombreImagen()
      {
        $sql = "CAll SP_guardarNombreImagen(?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->bindParam(2, $this->prioridad);
          $stm->bindParam(3, $this->idProducto);
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

      public function ActualizarNombreImagen()
      {
        $sql = "CAll SP_actualizarNombreImagen(?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->bindParam(2, $this->prioridad);
          $stm->bindParam(3, $this->idProducto);
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

      public function ConsultarImagenPorIdProducto()
      {
        $sql = "CAll SP_consultarImagenPorIdProducto(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarImagenPrioridad2()
      {
        $sql = "CAll SP_consultarImagenPrioridad2(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarImagenPrioridad3()
      {
        $sql = "CAll SP_consultarImagenPrioridad3(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idProducto);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function EliminarImagenProducto()
      {
        $sql = "CAll SP_eliminarImagenProducto(?)";

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
