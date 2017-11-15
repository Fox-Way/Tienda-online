<?php

class mdlLogin
{

  private $email;
  private $pass;
  private $rol;
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

  public function buscarUsuario()
  {
    $sql = "CALL SP_buscar_usuario(?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->email);
    $stm->bindParam(2, $this->pass);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }
}
