<?php

    class mdlCuentas
    {

      private $idUsuario;
      private $usuario;
      private $email;
      private $pass;
      private $rol;
      private $estadoUsuario;
      private $idPersona;
      private $nombres;
      private $apellidos;
      private $fechaNacimiento;
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

      public function ConsultarEmailUsuario()
      {
        $sql = "CAll SP_consultarEmailUsuario(?,?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->email);
          $stm->bindParam(2, $this->idUsuario);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error consultando el email del usuario');
        }
      }

      public function ConsultarEmail()
      {
        $sql = "CAll SP_consultarEmail(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->email);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error consultando el email del usuario');
        }
      }

      public function ConsultarUltimoUsuarioGuardado()
      {
        $sql = "CAll SP_consultarUltimoUsuario()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error consultando el ultimo usuario guardado');
        }
      }

      public function ConsultarNombreUsuario()
      {
        $sql = "CAll SP_consultarNombreUsuario(?,?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->usuario);
          $stm->bindParam(2, $this->idUsuario);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function ConsultarUsuarioPorId()
      {
        $sql = "CAll SP_consultarUsuarioPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idUsuario);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function ConsultarNombreUsuarioPorId()
      {
        $sql = "CAll SP_consultarNombreUsuarioPorId(?,?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->usuario);
          $stm->bindParam(2, $this->idUsuario);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }


        public function ConsultarEmailPorId()
        {
          $sql = "CAll SP_consultarEmailPorId(?,?)";
          try {
            $stm = $this->db->prepare($sql);
            $stm->bindParam(1, $this->email);
            $stm->bindParam(2, $this->idUsuario);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
        }

      public function ConsultarUsuariosPorId()
      {
        $sql = "CAll SP_consultarUsuariosPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idUsuario);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function ConsultarRoles()
      {
        $sql = "CAll SP_consultarRoles()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function ConsultarPersonaPorId()
      {
        $sql = "CAll SP_consultarPersonaPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idUsuario);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function ConsultarUsuario()
      {
        $sql = "CAll SP_consultarUsuario(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->usuario);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function ListarUsuarios()
      {
        $sql = "CAll SP_listarUsuarios()";
        try {
          $stm = $this->db->prepare($sql);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }

      public function ActualizarUsuarios()
      {
        $sql = "CAll SP_actualizarUsuarios(?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->usuario);
          $stm->bindParam(2, $this->email);
          $stm->bindParam(3, $this->idUsuario);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error en la actualización del usuario');
        }
      }

      public function ActualizarUsuario()
      {
        $sql = "CAll SP_actualizarUsuario(?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->usuario);
          $stm->bindParam(2, $this->email);
          $stm->bindParam(3, $this->idUsuario);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error en la actualización del usuario');
        }
      }

      public function ActualizarPersonaPorId()
      {
        $sql = "CAll SP_actualizarPersonaPorId(?,?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->fechaNacimiento);
          $stm->bindParam(2, $this->nombres);
          $stm->bindParam(3, $this->apellidos);
          $stm->bindParam(4, $this->idUsuario);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error en la actualización de la persona');
        }
      }

      public function GuardarUsuario()
      {
        $sql = "CAll SP_guardarUsuario(?,?,?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->usuario);
          $stm->bindParam(2, $this->email);
          $stm->bindParam(3, $this->pass);
          $stm->bindParam(4, $this->rol);
          $stm->bindParam(5, $this->estadoUsuario);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error guardando el usuario');
        }
      }

      public function GuardarDatosPersona()
      {
        $sql = "CAll SP_guardarDatosPersona(?,?,?,?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->nombres);
          $stm->bindParam(2, $this->apellidos);
          $stm->bindParam(3, $this->fechaNacimiento);
          $stm->bindParam(4, $this->idUsuario);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error guardando los datos de la persona(usuario)');
        }
      }

      public function CambiarEstadoUsuario()
      {
        $sql = "CAll SP_cambiarEstadousuario(?)";

        $this->db->beginTransaction();

        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idUsuario);
          $result = $stm->execute();

          if ($result == true) {
            $this->db->commit();
          } else {
            $this->db->rollback();
          }

          return $result;
        } catch (PDOException $e) {
          exit('Error cambiando el estado del usuario');
        }
      }
    }
 ?>
