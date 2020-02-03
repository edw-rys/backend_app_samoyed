<?php 

class EmployeeModel extends Model
{
  public $id_employeeame;
  public $name;
  public $last_name;
  public $dni;
  public $date_of_admission;
  
  public $title_academic;
  public $level_academic;
  public $salary;
  public $tipo_de_pago;
  public $gender;
  public $birthDate;
  public $telf;
  //
  public $department;
  public $cargo;
  public $nacionality;
  public function get($params =null){
    $params = parent::clearData($params);
    $sql="SELECT ".$params["_sql_params"]." from employee ";
    if( !is_null($params["condition"]) ){
        $sql  = $sql ." where ". $params["condition"];
    }
    try{
        return parent::sql([
            "sql"           => $sql,
            "params"        => $params["params"],
            "type"          => "query",
            "fetch"         => isset($params["fetch"])?$params["fetch"]:null,
            "fetch_type"    => isset($params["fetch_type"])?$params["fetch_type"]:null,
            "class"         => (isset($params["fetch_type"]) && $params["fetch_type"]=="class")?"Product":null,
        ]);
    }catch(Exception $ex){
        die($ex);
    }
}
  /**
   * Método para agregar un nuevo usuario
   *
   * @return integer
   */
  public function add()
  {
    $sql = 'insert into employee ( name,last_name,dni,telf,birthDate,gender,id_nacionality,tipo_de_pago,salary, level_academic,title_academic,id_cargo,id_department,date_of_admission,created_at) '.
    'VALUES '.
    '(:name,:last_name,:dni,:telf,:birthDate,:gender,:id_nacionality,:tipo_de_pago,:salary, :level_academic,:title_academic,:id_cargo,:id_department,:date_of_admission,now())';
    $user = 
    [
      "name"=>$this->name,
      "last_name"=>$this->last_name,
      "dni"=>$this->dni,
      "date_of_admission"=>$this->date_of_admission,
      "id_department"=>$this->id_department,
      "id_cargo"=>$this->id_cargo,
      "title_academic"=>$this->title_academic,
      "level_academic"=>$this->level_academic,
      "salary"=>$this->salary,
      "tipo_de_pago"=>$this->tipo_de_pago,
      "id_nacionality"=>$this->id_nacionality,
      "gender"=>$this->gender,
      "birthDate"=>$this->birthDate,
      "telf"=>$this->telf
    ];

    try {
      return ($this->id = parent::sql([
          "sql"   =>$sql, 
          "params"=>$user,
          "type"  =>"insert"
        ])) ? $this->id : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Método para actualizar un registor en la db
   *
   * @return bool
   */
  public function update()
  {
    $sql = 'UPDATE users SET name=:name, username=:username, email=:email,url_image:url_image WHERE id=:id';
    $user = 
    [
      'id'         => $this->id,
      'name'       => $this->name,
      'username'   => $this->username,
      'url_image'  => $this->url_image,
      'email'      => $this->email
    ];

    try {
      return (parent::query($sql, $user)) ? true : false;
    } catch (Exception $e) {
      throw $e;
    }
  }
}