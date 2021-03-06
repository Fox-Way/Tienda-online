<?php

    class mdlProductos
    {

      private $id;
      private $nombre;
      private $precio;
      private $descuento;
      private $descripcion;
      private $categoria;
      private $cantidad;
      private $inicio;
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

      public function ConsultarProductosPorNombre()
      {
        $sql = "CAll SP_ConsultarProductosPorNombre(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarProductoPorId()
      {
        $sql = "CAll SP_ConsultarProductosPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarProductosConImagen()
      {
        $sql = "CAll SP_ConsultarTodosProductosConImagen()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function consultarUltimoIdProducto()
      {
        $sql = "CAll SP_consultarUltimoIdProducto()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function GuardarProductos()
      {
        $sql = "CAll SP_guardarProductos(?,?,?,?,?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->bindParam(2, $this->precio);
          $stm->bindParam(3, $this->descripcion);
          $stm->bindParam(4, $this->categoria);
          $stm->bindParam(5, $this->inicio);
          $stm->bindParam(6, $this->cantidad);
          $stm->bindParam(7, $this->descuento);
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
