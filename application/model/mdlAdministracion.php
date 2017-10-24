<?php

    class mdlAdministracion
    {
      private $email;
      private $password;
      private $rol;
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

      public function ConsultarUsuarios()
      {
        $sql = "CAll SP_consultarUsuarios(?,?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->email);
          $stm->bindParam(2, $this->password);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }

      public function ConsultarRolPorId()
      {
        $sql = "CAll SP_consultarRolPorId(?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->email);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          exit('Error en la consulta');
        }
      }
    }
 ?>
