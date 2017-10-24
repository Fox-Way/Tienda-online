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

      public function guardarNombreImagen()
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
    }
 ?>
