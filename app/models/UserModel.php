<?php 

class UserModel extends Model
{

  public $id;
  public $username;
  public $password;

  public function create(){
    echo json_encode([
        "status"=>"error",
        "message"=>"Función no disponible",
    ]);
    die();
    try{
        return Model::sql([
            "sql"=>"INSERT INTO  user_(username, password) values (:username, :password);",
            "params"=>[
                "username"=>$this->username,
                "password"=>$this->password
            ],
            "type"=>"insert"
        ]);
    } catch (Exception $e) {
        die($e->getMessage());
        die($e->trace());
    }
}
  public function checkUser($username, $password){
    try{
        $user = Model::sql([
            "sql"=>"select * ".
                    "from user_  ".
                    "where username=:username;",
            "params"=>["username"=>$username],
            "fetch"=>"one"
        ]);
        if(empty($user)){
            return null;
        }else{				
            if(password_verify($password,$user->password)){
                return $user;
            }
            return null;
        }
    } catch (Exception $e) {
        die($e->getMessage());
        die($e->trace());
    }
}
}