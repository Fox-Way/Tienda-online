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
      private $tamanio;
      private $pagina;
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
        $sql = "CAll SP_consultarProductosPorNombre(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }


      public function ConsultarProductosPorCategoria()
      {
        $sql = "CAll SP_consultarProductosPorCategoria(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->categoria);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarProductosParaPaginador()
      {
        $sql = "CAll SP_consultarProductosParaPaginador(?,?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->pagina);
          $stm->bindParam(2, $this->tamanio);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarProductos()
      {
        $sql = "CAll SP_consultarProductos(?,?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombre);
          $stm->bindParam(2, $this->id);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarProductosPorEstadoActivo()
      {
        $sql = "CAll SP_consultarProductosActivos()";
        try {
          $stm = $this->db->prepare($sql);
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarProductoPorId()
      {
        $sql = "CAll SP_consultarProductosPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }


      public function ConsultarEstadoProductoPorId()
      {
        $sql = "CAll SP_consultarEstadoProductoPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function EliminarProducto()
      {
        $sql = "CAll SP_eliminarProducto(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
          $stm->execute();
          $result = $stm->execute();
          return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      }

      public function ConsultarProductosConImagen()
      {
        $sql = "CAll SP_consultarTodosProductosConImagen()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarUltimoIdProducto()
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

      public function ActualizarProductos()
      {
        $sql = "CAll SP_actualizarProductos(?,?,?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
          $stm->bindParam(2, $this->nombre);
          $stm->bindParam(3, $this->precio);
          $stm->bindParam(4, $this->descuento);
          $stm->bindParam(5, $this->descripcion);
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

      public function CambiarEstadoProductoActivado()
      {
        $sql = "CAll SP_cambiarEstadoProductosActivados(?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
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

      public function CambiarEstadoProductoPorCategoria()
      {
        $sql = "CAll SP_cambiarEstadoProductosPorCategoria(?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->categoria);
          $result = $stm->execute();
          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error en la actualizacion del estado');
        }
      }

      public function CambiarEstadoProductoDesactivado()
      {
        $sql = "CAll SP_cambiarEstadoProductosDesactivados(?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->id);
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
