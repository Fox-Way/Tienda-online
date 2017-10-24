<?php

    class mdlCategorias
    {

      private $idCategoria;
      private $nombre;
      private $estado;
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

      public function ConsultarCategoriasPorNombre()
      {
        $sql = "CAll SP_consultarCategoriasPorNombre(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarCategoriaPorId()
      {
        $sql = "CAll SP_consultarCategoriasPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idCategoria);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarCategorias()
      {
        $sql = "CAll SP_consultarCategorias()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function GuardarCategorias()
      {
        $sql = "CALL 	SP_guardarCategorias(?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->bindParam(2, $this->estado);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error en la inserción de los datos');
        }
      }
    }
 ?>
