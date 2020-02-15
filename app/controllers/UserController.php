<?php
include_once MODELS."UserModel.php";
class UserController{
    private $userModel;
    private $jwt;
    public function __construct() {
        $this->userModel=new UserModel();
        $this->jwt = new JwtAuth();
    }
	public function index(){}
    public function signup(){
            //en caso de la ausencia de algún campo, retornar =>faltan campos
        if(!(isset($_REQUEST['username']) && isset($_REQUEST['password']) )){
            $data=[
                "title"=>"Registro",
                "message"=>"Compelte todos los campos, por favor!",
                "code"=>400,
                "status"=>"error"
            ];
        } else{
            $this->userModel->username = $_REQUEST['username'];
            $this->userModel->password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT , ['cost'=>10]);
            $num=$this->userModel->create();
            if($num>0){
                $data=[
                    "title"=>"Login",
                    "message"=>"Usuario Registrado",
                    "code"=>200,
                    "status"=>"success"
                ];
            }else{
                $data=[
                    "title"=>"Registro",
                    "message"=>"Error al guardar",
                    "code"=>400,
                    "status"=>"error"
                ];
            }
        }
        echo json_encode($data);      
    }
    
    public function login($getToken=null){
        $user=isset($_REQUEST['username'])?strtolower($_REQUEST['username']):'';
        $password=isset($_REQUEST['password'])?$_REQUEST['password']:'';
        // $results = $this->userModel->checkUser($user,$password);        
        $results = $this->jwt->signup($user,$password,$this->userModel,$getToken);
        $data=[
            "title"=>"Login"
        ];
        if($results["code"]==400){
            $data=[
                "title"=>"Login",
                "message"=>"usuario no encontrado",
                "code"=>404,"status"=>"error"
            ];
        }else{
            $user =  $results['user'];
            $_SESSION['USER_BCK_SYM']=serialize($user);
            // token
            $data=[
                "title"=>"Login",
                "user"=>$user,
                "code"=>200,
                "status"=>"success",
            ];
            if(is_null($getToken)){
                $data["token"] = $results["token"];
            }else{
                $data["identity"] = $results["identity"];
            }
        }
        echo json_encode($data);
    }
    public function logout(){
        session_destroy();
        Redirect::to(URL);
    }
}