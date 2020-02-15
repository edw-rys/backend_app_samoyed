<?php 

class PersonaModel extends Model
{

  public $id;
  public $name;
  public $last_name;
  public $created_at;

  /**
   * Método para agregar un nuevo usuario
   *
   * @return integer
   */
  public function add()
  {
    $sql = 'INSERT INTO datos (name, last_name, created_at) VALUES (:name, :last_name, now())';
    $user = 
    [
      'name'       => $this->name,
      'last_name'  => $this->last_name,
    ];

    try {
      return   parent::sql([
                "sql"           => $sql,
                "params"        => $user ,
                "type"          => "insert",
            ]);
    } catch (Exception $e) {
      throw $e;
    }
  }
}